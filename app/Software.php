<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $fillable = [
    	'name', 'version', 'command', 'after_commands', 'before_commands'
    ];
}
