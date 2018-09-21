<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Container;
use App\Location;
use App\Plan;
use App\Database;
use App\Software;

use phpseclib\Net\SSH2;
use phpseclib\Net\SFTP;

use Docker\Docker;
use Docker\DockerClientFactory;

use Docker\API\Model\HostConfig;
use Docker\API\Model\ContainersCreatePostBody;
use Docker\API\Model\ContainersCreatePostBodyNetworkingConfig;
use Docker\API\Model\NetworksIdConnectPostBody;
use Docker\API\Model\ContainersIdExecPostBody;
use Docker\API\Model\ExecIdStartPostBody;

class CreateContainer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $location, $plan, $domain, $user_id, $preinstall, $repos, $htaccess;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($location, $plan, $domain, $user_id, $preinstall = null, $repos = null, $htaccess = null)
    {
        $this->location = $location;
        $this->plan = $plan;
        $this->domain = $domain;
        $this->user_id = $user_id;
        $this->preinstall = $preinstall;
        $this->repos = $repos;
        $this->htaccess = $htaccess;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $location = Location::find($this->location);
        $plan = Plan::find($this->plan);
        $user = User::find($this->user_id);

        $container = Container::create([
            'name' => generate_name(),
            'hash' => generate_hash(),
            'ftp_password' => generate_password(),
            'domain' => strtolower($this->domain),
            'location_id' => $location->id,
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'change_password' => true
        ]);
        
        $container->createDatabases($container->id);

        $user->newSubscription($container->name, $plan->braintree_id)->create($user->braintree_id);

        $ssh = new SSH2($location->host, $location->port);
        $login = $ssh->login('root', $location->password);
        if(!$login)
        {
            return view('containers.new')->with('error', 'Error connecting to ' . $location->name . ' Location. Please contact support');
        }

        $ssh->exec('sudo groupadd ' . escapeshellarg($container->name));
        $ssh->exec('sudo useradd -m -g ' . escapeshellarg($container->name) . ' ' . escapeshellarg($container->name));
        $ssh->exec('sudo usermod -s /usr/lib/stfp-server ' . escapeshellarg($container->name));
        $ssh->exec('sudo usermod -a -G sftpusers,www-data,' . escapeshellarg($container->name) . ' ' . escapeshellarg($container->name));

        $ssh->exec('sudo chown -R ' . escapeshellarg($container->name) . ':' . escapeshellarg($container->name) . '/home/' . escapeshellarg($container->name));
        $ssh->exec('sudo chmod 775 /home/' . escapeshellarg($container->name));

        $ssh->write('sudo passwd ' . escapeshellarg($container->name) . "\n");
        $ssh->read('Enter new UNIX password:');
        $ssh->write($container->ftp_password . "\n");
        $ssh->read('Retype new UNIX password:');
        $ssh->write($container->ftp_password . "\n");
        $ssh->setTimeout(0.5);

        $ssh->exec("docker run -itd --name " . escapeshellarg($container->name) . " --restart unless-stopped --net nginx-proxy -v /home/" . escapeshellarg($container->name) . ":/var/www/html -e 'LETSENCRYPT_EMAIL=" . $user->email . "' -e 'VIRTUAL_PORT=443' -e 'LETSENCRYPT_HOST=" . escapeshellarg($container->domain) . "' -e 'VIRTUAL_HOST=" . escapeshellarg($container->domain) . "' lynn_hosting_php7.2");

        $software = Software::find($this->preinstall);
        if($software !== null)
        {
            $full_command = "/bin/bash -c '";
            $before_commands = explode(',', $software->before_commands);
            if(!empty($before_commands))
            {
                foreach($before_commands as $command)
                {
                    $full_command .= $command . ' && ';
                }
            }
            else
            {
                $full_command .= $software->before_command . ' && ';
            }

            $commands = explode(',', $software->command);
            if(!empty($commands))
            {
                foreach($commands as $command)
                {
                    $full_command .= $command . ' && ';
                }
            }
            else
            {
                $full_command .= $software->command . ' && ';
            }

            $after_commands = explode(',', $software->after_commands);
            if(!empty($after_commands))
            {
                foreach($after_commands as $command)
                {
                    $full_command .= $command . ' && ';
                }
            }
            else
            {
                $full_command .= $software->after_command . ' && ';
            }

            $full_command = rtrim($full_command, ' && ') . "'";
            $full_command = str_replace('\' && ', '\'', $full_command); //if no before commands are set ' && is pushed to the start of the main command
            $ssh->exec('docker exec -d ' . $container->name . ' ' . $full_command);
            error_log('docker exec -d ' . $container->name . ' ' . $full_command);
        }

        if($this->repos !== null && strlen($this->repos) > 0)
        {
            $full_command = '';
            $repos = explode(',', $this->repos);
            if(!empty($repos))
            {
                foreach($repos as $repo)
                {
                    $full_command .= ' composer require --ignore-platform-reqs ' . $repo . ' && ';
                }
            }
            else
            {
                $full_command .= ' composer require --ignore-platform-reqs ' . $this->repos . ' && ';
            }

            $ssh->exec('docker exec -d ' . $container->name . ' /bin/bash -c ' . escapeshellarg($full_command));
        }
    } 
}
