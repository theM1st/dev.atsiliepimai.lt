<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use App\Traits\Uploader;

class Listing extends Model
{
    use Uploader;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'listing_type', 'picture', 'active', 'category_id', 'brand_value'];

    protected static function boot()
    {
        parent::boot();

        if (\Request::segment(1) != 'admin') {
            static::addGlobalScope(new ActiveScope);
        }
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public static function getSortby()
    {
        return [
            'newest' => trans('common.form.listing.sortby.newest'),
            'rating_high' => trans('common.form.listing.sortby.rating_high'),
            'number_of_reviews' => trans('common.form.listing.sortby.number_of_reviews'),
        ];
    }

    public function getReviews($filter, $limit=3)
    {
        $data = $this->reviews()->filter($filter)->paginate($limit);

        return $data;
    }

    public function getQuestions($filter)
    {
        $data = $this->questions()->latest()->filter($filter)->get();

        return $data;
    }

    public function lastReview()
    {
        return $this->reviews()->orderBy('created_at', 'desc')->first();
    }

    public function setRecentViewed()
    {
        if (\Auth::check()) {
            \Auth::user()->viewedListings()->detach($this->id);
            \Auth::user()->viewedListings()->attach($this->id);
        } else {
            $expiresAt = \Carbon\Carbon::now()->addDays(30);

            $recentViewed = \Cache::get('recentViewedListings');

            if (!$recentViewed) {
                $recentViewed = collect();
            }

            $recentViewed->prepend($this);
            $recentViewed = $recentViewed->unique()->take(10);

            \Cache::put('recentViewedListings', $recentViewed, $expiresAt);
        }
    }

    public function getSimilarListings()
    {
        $listings = $this->category->listings()->where('id', '!=', $this->id)->get();

        if ($listings->count()) {
            return $listings->shuffle()->take(5);
        }

        return null;
    }

    public static function recentViewed()
    {
        if (\Auth::check()) {
            $data = \Auth::user()->viewedListings()->orderBy('pivot_created_at', 'desc')->get();
        } else {
            $data = \Cache::get('recentViewedListings');
        }

        return $data;
    }

    public function scopeFilter($query, $data)
    {
        $sort = isset($data['sort']) ? $data['sort'] : null;

        switch($sort) {
            case 'rating_high' : $query->orderBy('avg_rating', 'desc'); break;
            case 'number_of_reviews' : $query->withCount('reviews')->orderBy('reviews_count', 'desc');  break;
            default: $query->orderBy('created_at', 'desc');
        }

        if (isset($data['brand']->id)) {
            $query->where('brand_id', $data['brand']->id);
        }

        return $query;
    }

    public function getMainAttribute()
    {
        return $this->attributes()->main()->first();
    }

    public function getSecondaryAttributes()
    {
        return $this->attributes()->secondary()->get();
    }

    public function getDefaultPictureAttribute()
    {
        return 'default.jpg';
    }

    public function getBrandValueAttribute()
    {
        if ($this->brand) {
            return $this->brand->name;
        }

        return $this->attributes['brand_value'];
    }

    public function scopeCategorized($query, Category $category = null)
    {
        if (is_null($category)) {
            return $query->with('category');
        }

        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

        return $query->with('category')->whereIn('category_id', $categoryIds);
    }
}
