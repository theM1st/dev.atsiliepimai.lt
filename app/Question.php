<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'active', 'attribute_option_id', 'user_id'];

    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attributeOption()
    {
        return $this->belongsTo('App\AttributeOption');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['model'])) {
            $temp = explode('-', $data['model']);
            $optionId = end($temp);

            return $query->where('attribute_option_id', $optionId);
        }

        return $query;
    }

    public function scopeAttributeOption($query, $attributeOptionId)
    {
        return $query->where('attribute_option_id', $attributeOptionId);
    }
}
