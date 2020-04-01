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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // {{ route('home') }}

//Specialty
       
        //Muestran vistas
Route::get('/specialties', 'SpecialtyController@index'); // {{ url('specialies') }}
Route::get('/specialties/create', 'SpecialtyController@create'); //form registro
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
		//Realizan las acciones
Route::post('/specialties', 'SpecialtyController@store');// envío del form de registro
Route::put('/specialties/{specialty}', 'SpecialtyController@update'); //Edición de una especialidad 																		determinada
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy'); // Eliminar una especialidad


//Doctors

Route::resource('doctors','DoctorController');

//Patients