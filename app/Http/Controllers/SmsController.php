<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function handle(Request $request){
    	$from = $request->from;
 		$to = $request->to;
 		$text = $request->text;
 		$date = $request->date;
 		$id = $request->id;

 		$reply = explode("-",$text)[0];
 		$appointment = explode("-",$text)[1];

 		if($reply == "YES"){
 			$appointment = \App\Appointment::find($appointment);
 			$appointment->status = 1;
 			$appointment->save();
 		}

 		if($reply == "NO"){
 			$appointment = \App\Appointment::find($appointment);
 			$appointment->status = 2;
 			$appointment->save();
 		}
 		dispatch(new \App\Jobs\TellPatient($appointment));
    }
}
