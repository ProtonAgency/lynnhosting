<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Location extends Model
{
	use Cachable;
	
    protected $fillable = [
    	'hash', 'host', 'port', 'ssl', 'name', 'password', 'http_online', 'proxy_online', 'database_online', 'last_updated'
    ];
}
