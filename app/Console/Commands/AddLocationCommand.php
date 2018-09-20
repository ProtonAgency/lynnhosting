<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Location;

class AddLocationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:new {name} {host} {port} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a Lynn Hosting location.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Location::create([
            'name' => $this->argument('name'),
            'hash' => md5($this->argument('name')),
            'host' => $this->argument('host'),
            'port' => $this->argument('port'),
            'ssl' => false,
            'password' => $this->argument('password')
        ]);
    }
}
