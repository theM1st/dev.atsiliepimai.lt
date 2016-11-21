<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

/*
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('editAbout', 'ProfileController@editAbout')
        ->name('profile.editAbout');
});
*/
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('edit{section}', 'ProfileController@edit')
        ->name('profile.edit')->where('section', '(About|Photo|Address|Email|Password)');

    Route::put('{user}', 'ProfileController@update')->name('profile.update');
});

Route::get('/home', 'HomeController@index');