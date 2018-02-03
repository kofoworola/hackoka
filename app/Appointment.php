<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
     protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];
}
