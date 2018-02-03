<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function show($domain){
        $hospital = \App\Hospital::where('slug',$domain)->first();
        $data['hospital'] = $hospital;

        return view('admin.patients',$data);
    }

    public function add($domain){
    	$hospital = \App\Hospital::where('slug',$domain)->first();
    	if(!$hospital){
    		return redirect('/');
    	}
    	$data['hospital'] = $hospital;

    	return view('admin.add_patient',$data);
    }

    public function save(Request $request,$domain){
    		$this->validate($request,[
    		'fname' => 'required',
    		'lname' => 'required',
    		'email' => 'required',
    		'phone' => 'required',
    		'doctor' => 'required',
    	]);

    	$hospital = \App\Hospital::where('slug',$domain)->first();
    	$patient = \App\User::create([
    		'fname' => $request->fname,
    		'lname' => $request->lname,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'hospital_id' => $hospital->id,
    		'password' => bcrypt(trim(strtolower($request->fname.$request->lname))),
    	]);

    	$patient_id = round(microtime(true) * 1000);
    	$patient_id = str_replace(".", "", $patient_id);

    	$patient->patient_id = $patient_id;
    	$patient->save();

    	$doctor= \App\User::find($request->doctor);

    	$patient->assignRole('patient');

    	$doctor->patients()->attach($patient->id);

    	dispatch(new \App\Jobs\InviteUser($patient,trim(strtolower($request->fname.$request->lname)),'patient'));
    	return redirect()->back()->with('success','Patient has been created');
    
    }

    public function delete(Request $request){
        $doctor = \App\User::find($request->doctor);

        $doctor->delete();

        return redirect()->back()->with('success','Patient has been deleted');
    }
}
