<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => '{company}.hackoka.test','middleware' => ['auth']],function(){
    Route::get('/','DashboardController@dashboard')->name('dashboard');

    Route::get('doctors','Admin\DoctorController@show')->name('admin.doctors');
    Route::get('doctors/add','Admin\DoctorController@add')->name('admin.add_doctor');
    Route::post('doctors/add','Admin\DoctorController@save')->name('admin.add_doctor');
});

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
