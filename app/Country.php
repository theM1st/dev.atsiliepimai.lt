<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public static function getCountries()
    {
        return \Cache::remember('countries', 1440, function () {
            return Country::orderBy('position')->orderBy('updated_at', 'asc')->get();
        });
    }

    public static function rebuild()
    {
        \Cache::forget('countries');
        $countries = Country::getCountries();

        foreach ($countries as $k => $c) {
            if (($k+1) != $c->position) {
                $c->position = ($k+1);
                $c->save();
            }
        }
    }

    public static function lists($title, $key = 'id')
    {
        return Country::getCountries()
            ->pluck($title, $key);
    }

    public function setPosition($position)
    {
        $this->position = ($this->position > $position) ? $position-1 : $position;
        $this->save();

        $this->rebuild();
    }
}
