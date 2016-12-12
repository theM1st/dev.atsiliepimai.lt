<?php

Route::resource('listings', 'ListingsController');
Route::get('listings/{listing}/delete', 'ListingsController@delete')->name('listings.delete');
Route::get('listings/{listing}/reviews', 'ListingsController@reviews')->name('listings.reviews');

Route::resource('reviews', 'ReviewsController');
Route::get('reviews/{review}/delete', 'ReviewsController@delete')->name('reviews.delete');

Route::resource('categories', 'CategoriesController');
Route::get('categories/{category}/delete', 'CategoriesController@delete')->name('categories.delete');
Route::get('categories/{category}/move/{position}', 'CategoriesController@move')
    ->name('categories.move')->where(['position' => '[0-9]+']);

Route::resource('users', 'UsersController');
Route::get('users/{user}/edit{section}', 'UsersController@edit')
    ->name('users.edit')->where('section', '(About|Photo|Address|Email|Password)');
Route::get('users/{user}/delete', 'UsersController@delete')->name('users.delete');

Route::resource('countries', 'CountriesController');
Route::get('countries/{country}/delete', 'CountriesController@delete')->name('countries.delete');
Route::get('countries/{country}/move/{position}', 'CountriesController@move')
    ->name('countries.move')->where(['position' => '[0-9]+']);