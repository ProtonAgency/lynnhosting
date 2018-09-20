<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Location;

class FlushLocationStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush the online status of all locations.';

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
            $location->http_online = @fsockopen($location->host, 80, $num, $error, 2) !== false;
            $location->proxy_online = $location->http_online; //for now we'll assume that both are online
            $location->database_online = mysqli_connect($location->host, 'root', $location->password) !== false;
            $location->last_updated = date('l jS F G:i:s', time());
            $location->save();
        }

        $this->info('Updated Location Statuses');
    }
}
