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
    protected $fillable = ['title', 'description', 'listing_type', 'picture', 'active', 'category_id'];

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

    public function scopeFilter($query, $data)
    {
        $sort = isset($data['sort']) ? $data['sort'] : null;

        switch($sort) {
            case 'rating_high' : $query->orderBy('avg_rating', 'desc'); break;
            case 'number_of_reviews' : $query->withCount('reviews')->orderBy('reviews_count', 'desc');  break;
            default: $query->orderBy('created_at', 'desc');
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

    public function scopeCategorized($query, Category $category = null)
    {
        if (is_null($category)) {
            return $query->with('category');
        }

        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

        return $query->with('category')->whereIn('category_id', $categoryIds);
    }
}
