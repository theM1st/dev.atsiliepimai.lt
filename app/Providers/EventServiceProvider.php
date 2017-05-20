<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Request;
use App\User;
use App\Page;
use App\Category;
use App\Country;
use App\Listing;
use App\Review;
use App\UserReviewVote;
use App\Brand;
use App\MailMessage;
use App\MailBox;
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

        Category::deleted(function($category) {
            $category->deleteDirectory($category->getUploadPath());
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

        // Only fire if something changed
        User::updated(function($user) {
            //dd($user);
        });

        User::deleted(function($user) {
            $user->deleteDirectory($user->getUploadPath());
        });

        Page::creating(function($page) {
            $position = Page::max('position')+1;

            $page->position = $position;
        });

        Page::saving(function($page) {
            $page->slug = str_slug($page->title);
        });

        Page::saved(function() {
            Page::rebuild();
        });

        Page::deleted(function() {
            Page::rebuild();
        });

        Country::creating(function($country) {
            $position = Country::max('position')+1;

            $country->position = $position;
        });

        Country::created(function() {
            Country::rebuild();
        });

        Country::deleted(function() {
            Country::rebuild();
        });

        Listing::saving(function($listing) {
            if ($listing->listing_type == 'product') {
                $listing->address = null;
            }

            if ($listing->listing_type == 'service') {
                $listing->brand_id = null;
                $listing->brand_value = null;
            }

            if ($listing->brand_value) {
                $brand = Brand::where('slug', str_slug($listing->brand_value))->first();
                if ($brand) {
                    $listing->brand_id = $brand->id;
                    $listing->brand_value = null;
                }
            }
        });

        Listing::created(function($listing) {

            if (Request::get('review_title')) {
                $review = new Review([
                    'review_title' => Request::get('review_title'),
                    'review_description' => Request::get('review_description'),
                    'review_pros' => Request::get('review_pros'),
                    'review_cons' => Request::get('review_cons'),
                    'rating' => Request::get('rating'),
                    'active' => 0,
                    'user_id' => \Auth::user()->id,
                ]);
                $listing->reviews()->save($review);
            }
        });

        Listing::saved(function($listing) {
            $slug = str_slug($listing->title).'-'.$listing->id;

            if ($slug != $listing->slug) {
                $listing->slug = $slug;
                $listing->save();
            }
        });

        Listing::deleted(function($listing) {
            $listing->reviews()->delete();
        });

        Review::saved(function($review) {
            $this->listingAvgRating($review);
        });

        Review::deleted(function($review) {
            $this->listingAvgRating($review);
        });

        UserReviewVote::created(function($reviewVote) {
            $this->reviewAvgVotes($reviewVote);
        });

        Brand::creating(function($brand) {
            $position = Brand::max('position')+1;

            $brand->position = $position;
        });

        Brand::saved(function($brand) {
            $slug = str_slug($brand->name);

            if ($slug != $brand->slug) {
                $brand->slug = $slug;
                $brand->save();
            }
        });

        Brand::deleted(function($brand) {
            $brand->listings()->update([ 'brand_id' => null ]);
        });

        MailMessage::created(function($message) {
            $item = new MailBox;
            $item->user_id = $message->sender_id;
            $item->box = 'out';
            $item->message_id = $message->id;
            $item->save();

            $item = new MailBox;
            $item->user_id = $message->receiver_id;
            $item->box = 'in';
            $item->message_id = $message->id;
            $item->save();
        });
    }

    private function listingAvgRating($review)
    {
        if ($review->listing) {
            $review->listing->updateAvgRating();
        }
    }

    private function reviewAvgVotes($reviewVote)
    {
        if ($reviewVote->review) {
            $reviewVote->review->avg_votes = $reviewVote->review->votes()->avg('vote');
            $reviewVote->review->save();
        }
    }
}
