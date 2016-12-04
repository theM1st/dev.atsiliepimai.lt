<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['review_title', 'review_description', 'rating', 'active', 'user_id'];

    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }
}
