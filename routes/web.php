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
Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('sitemap.xml', 'SitemapsController@index');

Route::group(['prefix' => 'sitemap'], function () {
    Route::get('categories', 'SitemapsController@categories')
        ->name('sitemap.categories');
    Route::get('pages', 'SitemapsController@pages')
        ->name('sitemap.pages');
    Route::get('listings', 'SitemapsController@listings')
        ->name('sitemap.listings');
});

Route::get('c/{category_slug}', 'CategoriesController@show')
    ->name('category.show');

Route::get('c/{category_slug}/m/{brand_slug}', 'CategoriesController@show')
    ->name('category.show.brand');

Route::get('p/{listing_slug}', 'ListingsController@show')
    ->name('listing.show');

Route::get('p/{listing_slug}/m/{attribute_option_slug}', 'ListingsController@show')
    ->name('listing.show.model');

Route::get('p/all/recently-viewed-remove', 'ListingsController@recentlyViewedRemoveAll')
    ->name('listing.recently_viewed_remove_all');

Route::get('p/{listing_slug}/recently-viewed-remove', 'ListingsController@recentlyViewedRemove')
    ->name('listing.recently_viewed_remove');

Route::get('p/{listing_slug}/parasyti-atsiliepima', 'ReviewsController@create')
    ->name('review.create')
    ->middleware('auth');

Route::post('p/{listing_slug}/parasyti-atsiliepima', 'ReviewsController@store')
    ->name('review.store')
    ->middleware('auth');

Route::put('reviews/{user_review}', 'ReviewsController@update')
    ->name('review.update')
    ->middleware('auth');

Route::post('p/{listing_slug}/write-question', 'QuestionsController@store')
    ->name('question.store')
    ->middleware('auth');

Route::get('p/{listing_slug}/censor/{commentable_type}/{commentable_id}', 'CensorsController@create')
    ->name('censor.create')
    ->middleware('auth');

Route::post('censors', 'CensorsController@store')
    ->name('censor.store')
    ->middleware('auth');

Route::post('q/{question}/write-answer', 'AnswersController@store')
    ->name('answer.store')
    ->middleware('auth');

Route::get('search', 'ListingsController@search')
    ->name('listing.search');

Route::group(['prefix' => 'page'], function () {
    Route::get('{page_slug}', 'PagesController@show')
        ->name('page.show');

    Route::post('sendMessage', 'PagesController@sendMessage')
        ->name('page.sendMessage');
});

//Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

/*
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('editAbout', 'ProfileController@editAbout')
        ->name('profile.editAbout');
});
*/


Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/{section}', 'ProfileController@show')
        ->name('profile.show')->where('section', '(me|reviews|questions|answers)');

    Route::get('edit{section}', 'ProfileController@edit')
        ->name('profile.edit')->where('section', '(About|Photo|Address|Email|Password)');

    Route::put('{user}', 'ProfileController@update')->name('profile.update');

    Route::get('reviews/{user_review}/edit', 'ProfileController@editReview')
        ->name('profile.editReview');
});

Route::get('profile/{user}.html', 'UsersController@show')
    ->name('user.show');

Route::group(['prefix' => 'messages', 'middleware' => 'auth'], function () {
    Route::get('{section}', 'MessagesController@index')
        ->name('messages.index')->where('section', '(inbox|outbox)');

    Route::get('create/{user}', 'MessagesController@create')
        ->name('messages.create');

    Route::get('{section}/{subject}', 'MessagesController@show')
        ->where('section', '(inbox|outbox)')
        ->name('messages.show');

    Route::post('{subject}/reply', 'MessagesController@reply')
        ->where('section', '(inbox|outbox)')
        ->name('messages.reply');

    Route::get('delete', 'MessagesController@delete')
        ->name('messages.delete');

    Route::post('store', 'MessagesController@store')
        ->name('messages.store');

    Route::delete('destroy', 'MessagesController@destroy')
        ->name('messages.destroy');
});

Route::get('parasyti-atsiliepima', 'ListingsController@create')
    ->name('listing.create');

Route::get('ideti-produkta-paslauga', 'ListingsController@globalCreate')
    ->name('listing.global_create')
    ->middleware('auth');

Route::post('ideti-produkta-paslauga', 'ListingsController@store')
    ->name('listing.store')
    ->middleware('auth');

Route::post('reviews/{review}/vote', 'ReviewsController@vote')
    ->middleware('auth')
    ->name('reviews.vote');

Route::get('social/login/{provider}', 'SocialAuthController@login')
    ->where('provider', '(facebook|google|linkedin)')
    ->name('social.login');

Route::get('social/facebookCallback', 'SocialAuthController@facebookCallback');
Route::get('social/googleCallback', 'SocialAuthController@googleCallback');
Route::get('social/linkedinCallback', 'SocialAuthController@linkedinCallback');