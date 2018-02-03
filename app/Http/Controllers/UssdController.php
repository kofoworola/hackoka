<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UssdController extends Controller
{
    public function handle(Request $request){
    	$session_id = $request->sessionId;
    	$service_code = $request->serviceCode;
    	$phone_number = $request->phoneNumber;
    	$text = $request->text;

    	// return $text;

    	$session = \App\UssdSession::where('session_id',$session_id)->get();
    	if(count($session)<1){
    		$session = new \App\UssdSession();
    		$session->session_id= $session_id;
    		$session->phone = $phone_number;
    		$session->save();
    	}
    	else{
    		$session = $session[0];
    	}

    	if($text == ""){
    		echo "CON Please input your patient id";
    	}
    	else{
    		$items = $this->splitText($text);
    		$patient = null;
    		if(count($items) == 1){
    			$patient = \App\User::where('patient_id',$items[0])->first();
    			if(!$patient){
    				echo "END Please enter a valid value";
    			}
    			else{
    				$session->user_id = $patient->id;
    				echo "CON Choose a date for the appointment in the format yy-mm-dd HH:MM";
    			}
    		}
    		if(count($items) ==2){
    			$patient = \App\User::where('patient_id',$items[0])->first();
    			$date = Carbon::parse($items[1]);
    			$appointment = new \App\Appointment();
    			$appointment->patient_id = $patient->id;
    			$appointment->doctor_id = $patient->doctors[0]->id;
    			$appointment->start_date = $date;
    			$appointment->save();

                $session->appointment_id = $appointment->id;
                $session->save();

    			echo "CON Enter the end time in the format yy-mm--dd HH:MM";   			
    		}
            if(count($items) == 3){
                $patient = \App\User::where('patient_id',$items[0])->first();
                $date = Carbon::parse($items[2]);
                $appointment = $session->appointment;
                $appointment->end_date = $date;
                $appointment->save();
                $session->save();

                dispatch(new \App\Jobs\RequestAppointment($session->appointment));

                echo "END Your appointment request has been made";
            }
    	}
    }

    public function splitText($text){
    	return $items = explode('*', $text);
    }
}
