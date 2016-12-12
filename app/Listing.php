<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

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

    public function lastReview()
    {
        return $this->reviews()->orderBy('created_at', 'desc')->first();
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
