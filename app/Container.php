<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

use Illuminate\Support\Facades\DB;

use Docker\Docker;
use Docker\DockerClientFactory;

class Container extends Model
{
    use Cachable;
    
    protected $fillable = [
    	'name', 'hash', 'ftp_password', 'location_id', 'plan_id', 'user_id', 'domain', 'change_password'
    ];

    public function databases()
    {
        return $this->hasMany('App\Database');
    }

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }

    public function plan()
    {
    	return $this->belongsTo('App\Plan');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getStorageUsed()
    {
        return 'Unknown ';
    }

    public function createDatabases($id)
    {
        $user_name = $this->user->email;
        $user_id = $this->user->id;
        $password = generate_password();
        $db = new \mysqli($this->location->host, 'root', $this->location->password);
        $db->query("CREATE USER " . DB::connection()->getPdo()->quote($user_name) . "@`%` IDENTIFIED BY " . DB::connection()->getPdo()->quote($password));
        for($i = 0; $i <= $this->plan->databases; $i++)
        {
            $database = Database::create([
                'host' => $this->location->host,
                'name' => generate_name(),
                'user' => $user_name,
                'password' => $password,
                'user_id' => $user_id,
                'container_id' => $id,
                'change_password' => false
            ]);

            $db->query('CREATE DATABASE `' . $database->name . '`');
            $db->query('GRANT ALL PRIVLEDGES ON ' . $database->name . '.* TO ' . DB::connection()->getPdo()->quote($user_name) . '"');
        }
    }

    public function getStatus()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, (explode(',', $this->domain))[0]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        $response = curl_exec($ch);

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $code < 500; //500, 502/503 means that the container is offline
    }
}
