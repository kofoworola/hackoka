<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UssdSession extends Model
{
    protected $casts = [
        'active' => 'boolean',
    ];

    public function user(){
    	return $this->belongsTo('\App\User','user_id');
    }

    public function appointment(){
    	return $this->belongsTo('\App\Appointment');
    }
}
