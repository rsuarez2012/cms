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

Route::get('/', 'ContentController@getHome');
//crear nuestro sistema de autenticacion
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('login');
Route::get('/register', 'ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('register');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');
//comento el recuerar contraseña porque no tengo guzzle hay que actualizar laravel pero lo puedo hacer con mailtrap o mailgun
Route::get('/recover', 'ConnectController@getRecover')->name('recover');
Route::post('/recover', 'ConnectController@postRecover')->name('recover');
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::post('/reset', 'ConnectController@postReset')->name('reset');
