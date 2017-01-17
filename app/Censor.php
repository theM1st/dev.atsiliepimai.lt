<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Censor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'listing_id', 'user_id'];

    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
