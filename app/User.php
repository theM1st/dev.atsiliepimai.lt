<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'year', 'month', 'day'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'birthday'
    ];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * Set User birthday from request
     *
     * @param UserRequest $request
     * @return mixed
     */
    public function setBirthday($request)
    {
        if ($request->get('year') && $request->get('month') && $request->get('day')) {
            $this->birthday = Carbon::createFromDate(
                $request->get('year'),
                $request->get('month'),
                $request->get('day')
            );
        }
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        //$this->verified = true;
        //$this->token = null;
        //$this->save();
    }

    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = ($value?$value:null);
    }

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = ($value?$value:null);
    }

    public function getAdminAttribute()
    {
        if ($this->user_role == 'admin') {
            return true;
        }

        return false;
    }
}
