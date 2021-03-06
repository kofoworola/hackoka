<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $hospital;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public function redirectTo(){
        return route('dashboard',['domain' => $this->hospital->slug]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'slug' => 'required|string|unique:hospitals',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $this->hospital = \App\Hospital::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
        $user = User::create([
            'fname' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'hospital_id' => $this->hospital->id,
        ]);
        $user->assignRole('admin');

        return $user;
    }
}
