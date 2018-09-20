<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Plan extends Model
{
	use Cachable;
	
    protected $fillable = [
    	'name', 'databases', 'storage', 'bandwidth', 'emails', 'domains', 'price', 'braintree_id'
    ];
}
