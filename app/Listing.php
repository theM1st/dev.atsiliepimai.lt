<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use App\ReviewAttributeOption;

class Listing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'listing_type', 'active', 'category_id'];

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

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function getReviews($filter, $limit=3)
    {
        return $this->reviews()->filter($filter)->paginate($limit);
    }

    public function lastReview()
    {
        return $this->reviews()->orderBy('created_at', 'desc')->first();
    }

    public function getMainAttribute()
    {
        return $this->attributes()->main()->first();
    }

    public function getSecondaryAttributes()
    {
        return $this->attributes()->secondary()->get();
    }

    public function scopeCategorized($query, Category $category = null)
    {
        if (is_null($category)) {
            return $query->with('category');
        }

        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

        return $query->with('category')->whereIn('category_id', $categoryIds);
    }

    public function getReviewsByAttributeOption($option)
    {
        $reviews = $this->reviews->pluck('id');
        
        return ReviewAttributeOption::whereIn('review_id', $reviews)->where('option_id', $option->id)->get();

        //return $query->with('category')->whereIn('category_id', $categoryIds);
    }
}
