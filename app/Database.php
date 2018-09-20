<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Database extends Model
{
	use Cachable;
	
    public $fillable = [
    	'host', 'user', 'password', 'name', 'user_id', 'container_id', 'change_password'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function container()
    {
    	return $this->belongsTo('App\Container');
    }
}
