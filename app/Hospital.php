<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function doctors(){
    	return User::role('doctor')->where('hospital_id',$this->id)->get();
    }
}
