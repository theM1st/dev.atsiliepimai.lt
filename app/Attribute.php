<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'title', 'main'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function options()
    {
        return $this->hasMany('App\AttributeOption');
    }

    public function listings()
    {
        return $this->belongsToMany('App\Listing');
    }

    public function scopeMain($query)
    {
        return $query->where('main', 1);
    }

    public function scopeSecondary($query)
    {
        return $query->where('main', 0);
    }
}
