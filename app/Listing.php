<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'listing_type', 'active', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function scopeCategorized($query, Category $category = null)
    {
        if (is_null($category)) {
            return $query->with('categories');
        }

        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

        return $query->with('categories')->whereIn('category_id', $categoryIds);
    }
}
