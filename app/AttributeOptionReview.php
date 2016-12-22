<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeOptionReview extends Model
{
    protected $table = 'attribute_option_review';

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
    protected $fillable = ['review_id', 'attribute_id', 'attribute_option_id', 'option_value'];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }
}
