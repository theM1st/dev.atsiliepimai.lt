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

        \Validator::extend('foo', function ($attribute, $value, $parameters, $validator) {
            //dd(\Auth::user()->password);
            //if (Hash::check("param1", "param2")) {
                //add logic here
            //}
            return $value == 'foo';
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
