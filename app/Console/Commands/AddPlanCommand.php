<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Plan;

class AddPlanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:new {name} {databases} {storage} {bandwidth} {emails} {domains} {price} {braintree_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Lynn Hosting plan.';

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
        Plan::create([
            'name' => $this->argument('name'),
            'databases' => $this->argument('databases'),
            'storage' => $this->argument('storage'),
            'bandwidth' => $this->argument('bandwidth'),
            'emails' => $this->argument('emails'),
            'domains' => $this->argument('domains'),
            'price' => $this->argument('price'),
            'braintree_id' => $this->argument('braintree_id')
        ]);
    }
}
