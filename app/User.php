<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname' ,'email', 'password','hospital_id','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    public function fullName(){
        return $this->fname. " ". $this->lname;
    }

    public function patients()
    {
        return $this->belongsToMany('App\User','doctor_patient','doctor_id','patient_id');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\User','doctor_patient','patient_id','doctor_id');
    }
}
