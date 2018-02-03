<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function show($domain){
    	$hospital = \App\Hospital::where('slug',$domain);
    	$data['hospital'] = $hospital;

    	return view('admin.doctors',$data);
    }

    public function add($domain){
    	$hospital = \App\Hospital::where('slug',$domain)->first();
    	if(!$hospital){
    		return redirect('/');
    	}
    	$data['hospital'] = $hospital;

    	return view('admin.add_doctors',$data);
    }

    public function save(Request $request, $domain){
    	$this->validate($request,[
    		'fname' => 'required',
    		'lname' => 'required',
    		'email' => 'required',
    		'phone' => 'required',
    	]);

    	$hospital = \App\Hospital::where('slug',$domain)->first();
    	$doctor = \App\User::create([
    		'fname' => $request->fname,
    		'lname' => $request->lname,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'hospital_id' => $hospital->id,
    		'password' => bcrypt(trim(strtolower($request->fname.$request->lname))),
    	]);

    	$doctor->assignRole('doctor');

    	return redirect()->back()->with('success','Doctor has been created');
    }

}
