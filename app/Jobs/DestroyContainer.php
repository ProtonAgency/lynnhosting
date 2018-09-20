<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Container;

use phpseclib\Net\SSH2;
use phpseclib\Net\SFTP;

class DestroyContainer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $container = Container::find($this->id);
        if($container === null)
        {
            return;
        }

        $ssh = new SSH2($container->location->host, $container->location->port);
        $login = $ssh->login('root', $container->location->password);
        if(!$login)
        {
            return;
        }

        $ssh->exec('docker container stop ' . escapeshellarg($container->name));
        $ssh->exec('docker container rm ' . escapeshellarg($container->name));

        $ssh->exec('userdel -r ' . escapeshellarg($container->name));
        $ssh->setTimeout(0.5);

        $db = new \mysqli($container->location->host, 'root', $container->location->password);
        foreach($container->databases as $database)
        {
            $db->query('DROP DATABASE ' . $db->real_escape_string($database->name));
            $database->delete();
        }

        $db->query('DROP USER ' . $db->real_escape_string($container->user->email));
        $container->delete();
    }
}
