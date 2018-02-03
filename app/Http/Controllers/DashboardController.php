<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard($domain){
    	$hospital = \App\Hospital::where('slug',$domain)->first();
    	return view('admin.dashboard');
    }
}
