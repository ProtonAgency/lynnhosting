<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Location;

class LocationStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View the status of all locations.';

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
        $locations = Location::all();
        foreach($locations as $location)
        {
            $rows[] = [
                $location->name,
                $location->http_online ? 'Operational' : 'Offline',
                $location->proxy_online ? 'Operational' : 'Offline',
                $location->database_online ? 'Operational' : 'Offline',
                (bool) $location->http_online === true && (bool) $location->database_online === true ? 'All Systems Operational' : 'Some Systems Offline'
            ];
        }

        $headers = [
            'Location',
            'HTTP Server Online',
            'Proxy Server Online',
            'Database Provider Online',
            'Status'
        ];

        $this->table($headers, $rows);
    }
}
