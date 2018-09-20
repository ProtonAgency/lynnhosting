<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Container;
use App\Events\ContainerCommandResponseEvent;

use phpseclib\Net\SSH2;
use phpseclib\Net\SFTP;

class CommandSubmitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $container;

    protected $command;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Container $container, $command)
    {
        $this->container = $container;
        $this->command = $command;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ssh = new SSH2($this->container->location->host, $this->container->location->port);
        $login = $ssh->login('root', $this->container->location->password);
        if(!$login)
        {
            return;
        }

        $output = $ssh->exec('docker exec -t ' . $this->container->name . ' /bin/bash -c ' . escapeshellarg($this->command) . ' 2>&1');
        event(new ContainerCommandResponseEvent($this->container->name, $output));
    }
}
