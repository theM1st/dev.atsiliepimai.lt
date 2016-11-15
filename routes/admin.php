<?php

Route::resource('categories', 'CategoriesController');
Route::get('categories/{category}/delete', 'CategoriesController@delete')->name('categories.delete');
Route::get('categories/{category}/move/{position}', 'CategoriesController@move')
    ->name('categories.move')->where(['position' => '[0-9]+']);

Route::resource('users', 'UsersController');
Route::get('users/{user}/edit/{section?}', 'UsersController@edit')->name('users.edit');
Route::get('users/{user}/delete', 'UsersController@delete')->name('users.delete');

Route::resource('countries', 'CountriesController');
Route::get('countries/{country}/delete', 'CountriesController@delete')->name('countries.delete');
Route::get('countries/{country}/move/{position}', 'CountriesController@move')
    ->name('countries.move')->where(['position' => '[0-9]+']);