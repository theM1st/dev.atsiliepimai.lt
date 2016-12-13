<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['review_title', 'review_description', 'rating', 'active', 'user_id'];

    public function votes()
    {
        return $this->hasMany('App\UserReviewVote');
    }

    protected static function boot()
    {
        parent::boot();

        if (\Request::segment(1) != 'admin') {
            static::addGlobalScope(new ActiveScope);
        }
    }

    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
