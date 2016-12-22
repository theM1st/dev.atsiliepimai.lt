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

Route::get('/', 'PagesController@index');

Route::get('c/{category_slug}', 'CategoriesController@show')
    ->name('category.show');

Auth::routes();
//Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

/*
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('editAbout', 'ProfileController@editAbout')
        ->name('profile.editAbout');
});
*/
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/{section}', 'ProfileController@show')
        ->name('profile.show')->where('section', '(me|reviews)');

    Route::get('edit{section}', 'ProfileController@edit')
        ->name('profile.edit')->where('section', '(About|Photo|Address|Email|Password)');

    Route::put('{user}', 'ProfileController@update')->name('profile.update');
});

Route::post('reviews/{review}/vote', 'ReviewsController@vote')
    ->middleware('auth')
    ->name('reviews.vote');

Route::get('/home', 'HomeController@index');