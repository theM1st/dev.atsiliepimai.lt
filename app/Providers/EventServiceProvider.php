<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Category;
use App\Country;
use App\Mail\UserConfirm;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Category::saving(function($category) {
            $category->slug = str_slug($category->name);
        });

        User::creating(function($user) {
            //$user->token = str_random(30);
        });

        User::created(function($user) {

            if ($user->email && !$user->provider_uid) {
                //Mail::to($user->email)->send(new UserConfirm($user));
            }

            return true;
        });

        Country::creating(function($country) {
            $position = Country::max('position')+1;

            $country->position = $position;
        });

        Country::created(function() {
            Country::rebuild();
        });

        Country::deleted(function($country) {
            Country::rebuild();
        });
    }
}