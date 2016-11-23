<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::component('birthday', 'components.form.birthday', ['value']);
        \Form::component('actions', 'components.form.actions', ['actions']);

        \Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, \Auth::user()->password);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
