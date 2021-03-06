<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'attribute_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function reviews($listingId)
    {
        return $this->belongsToMany('App\Review')->where('listing_id', $listingId);
    }

    public static function attributeOptionBySlug($slug)
    {
        $data = explode('-', $slug);
        $id = end($data);

        return AttributeOption::find($id);
    }
    
    public function getSlugAttribute()
    {
        return str_slug($this->option_name . ' ' . $this->id);
    }
}
