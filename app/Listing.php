<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function categories()
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
