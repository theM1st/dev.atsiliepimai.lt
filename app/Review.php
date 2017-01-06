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

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute', 'attribute_option_review')
            ->withPivot('attribute_option_id', 'option_value');
    }

    public function attributeOptions()
    {
        return $this->belongsToMany('App\AttributeOption')
            ->withPivot('attribute_id', 'option_value');
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

    public static function getSortby()
    {
        return [
            'newest' => trans('common.form.review.sortby.newest'),
            'rating_high' => trans('common.form.review.sortby.rating_high'),
            'rating_low' => trans('common.form.review.sortby.rating_low'),
            'helpful' => trans('common.form.review.sortby.helpful'),
            'oldest' => trans('common.form.review.sortby.oldest'),
        ];
    }

    public static function getRatings()
    {
        return [
            5 => trans('common.form.review.rating_values.excellent'),
            4 => trans('common.form.review.rating_values.good'),
            3 => trans('common.form.review.rating_values.ok'),
            2 => trans('common.form.review.rating_values.bad'),
            1 => trans('common.form.review.rating_values.terrible'),
        ];
    }

    public function saveOptions($data)
    {
        $this->attributes()->detach();

        if (is_array($data['attribute_option_id'])) {
            foreach ($data['attribute_option_id'] as $attributeId => $optionId) {
                $optionValue = null;

                if (!$optionId) {
                    $optionId = null;
                    $optionValue = $data['option_value'][$attributeId];
                }

                if ($optionId || $optionValue) {
                    $this->attributes()->attach($attributeId, [
                        'attribute_option_id' => $optionId,
                        'option_value' => $optionValue,
                    ]);
                }
            }
        }
    }

    public function getReviewAttribute($attributeId)
    {
        return $this->attributes()->where('attribute_id', $attributeId)->first();
    }

    public function getReviewAttributeOption($attributeId)
    {
        return $this->attributeOptions()->where('attribute_option_review.attribute_id', $attributeId)->first();
    }

    public function scopeFilter($query, $data)
    {
        $sort = isset($data['sort']) ? $data['sort'] : null;

        if (isset($data['model'])) {
            $temp = explode('-', $data['model']);
            $optionId = end($temp);

            $query->whereHas('attributeOptions', function ($query) use ($optionId) {
                $query->where('attribute_option_id', $optionId);
            });
        }

        if (isset($data['filter'])) {
            foreach ($data['filter'] as $optionId) {
                if ($optionId) {
                    $query->whereHas('attributeOptions', function ($query) use ($optionId) {
                        $query->where('attribute_option_id', $optionId);
                    });
                }
            }
        }

        switch($sort) {
            case 'rating_high' : $query->orderBy('rating', 'desc'); break;
            case 'rating_low' : $query->orderBy('rating', 'asc')->orderBy('created_at', 'desc'); break;
            case 'helpful' : $query->orderBy('avg_votes', 'desc')->orderBy('created_at', 'desc'); break;
            case 'oldest' : $query->orderBy('created_at', 'asc'); break;
            default: $query->orderBy('created_at', 'desc');
        }

        //dd($query->toSql());
        return $query;
    }

    public function scopeOfRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function getMainAttributeAttribute()
    {
        return ($this->listing ? $this->listing->getMainAttribute() : null);
    }

    public function getSecondaryAttributesAttribute()
    {
        return ($this->listing ? $this->listing->getSecondaryAttributes() : null);
    }

    /*
    public function getAttributeOptionsAttribute()
    {
        $data = null;

        if ($this->reviewAttributeOptions) {

            foreach ($this->reviewAttributeOptions as $item) {
                $data[] = collect([
                    'review_id' => $item->review_id,
                    'attribute_id' => $item->attribute_id,
                    'option_id' => $item->attribute_option_id,
                    'option_value' => $item->option_value,
                    'attribute_title' => $item->attribute->title,
                    'option_name' => $item->attributeOption->option_name,
                    'attribute_main' => $item->attribute->main,
                ]);
            }

            $data = collect($data)->sortByDesc('attribute_main');
        }

        return $data;
    }*/
}
