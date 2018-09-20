<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Software;

class AddSoftwareCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'software:add {name} {version} {cmd} {--before=} {--after=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new software // you may use %h to represent the users home directory';

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
        Software::create([
            'name' => $this->argument('name'),
            'version' => $this->argument('version'),
            'command' => $this->argument('cmd'),
            'before_commands' => $this->option('before'),
            'after_commands' => $this->option('after')
        ]);
    }
}
