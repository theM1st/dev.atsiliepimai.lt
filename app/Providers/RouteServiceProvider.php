<?php

namespace App\Providers;

use App\MailSubject;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\User;
use App\Category;
use App\Country;
use App\Listing;
use App\Review;
use App\Attribute;
use App\AttributeOption;
use App\Answer;
use App\Message;
use App\Page;
use App\Brand;
use App\Scopes\ActiveScope;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * @var string
     */
    protected $adminNamespace = 'App\Http\Controllers\Admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::model('user', User::class);
        Route::model('category', Category::class);
        Route::model('country', Country::class);
        Route::model('listing', Listing::class);
        Route::model('review', Review::class);
        Route::model('attribute', Attribute::class);
        Route::model('attribute_option', AttributeOption::class);
        Route::model('answer', Answer::class);
        Route::model('subject', MailSubject::class);
        Route::model('page', Page::class);

        Route::bind('category_slug', function($slug) {
            $item = Category::where('slug', $slug)->first();

            if (!$item) abort(404);

            return $item;
        });

        Route::bind('listing_slug', function($slug) {
            $item = Listing::where('slug', $slug)->first();

            if (!$item) abort(404);

            return $item;
        });

        Route::bind('page_slug', function($slug) {
            $item = Page::where('slug', $slug)->first();

            if (!$item) abort(404);

            return $item;
        });

        Route::bind('brand_slug', function($slug) {
            $item = Brand::where('slug', $slug)->first();

            if (!$item) abort(404);

            return $item;
        });

        Route::bind('user_review', function($reviewId) {
            $review = \Auth::user()->reviews()
                ->withoutGlobalScope(ActiveScope::class)
                ->where('id', $reviewId)
                ->first();

            if (!$review) abort(404);

            return $review;
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => 'admin',
            'namespace' => $this->adminNamespace,
            'prefix' => 'admin',
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }
}
