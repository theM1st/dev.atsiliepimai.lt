<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReviewVote extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'review_id', 'vote'];

    public function review()
    {
        return $this->belongsTo('App\Review');
    }
}
