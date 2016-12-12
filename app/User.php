<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;
use App\Traits\Uploader;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use Uploader;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'password_confirmation', 'current_password', 'year', 'month', 'day', 'MAX_FILE_SIZE'
    ];

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

    public function reviews()
    {
        return $this->hasMany('App\Review');
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
    
    public function getPicture($size='sm')
    {
        if (!$this->picture) {
            return asset(
                'assets/images/profile/'.($this->gender ? $this->gender : 'male').'/'.$size.'.png'
            );
        }

        return '/' . $this->getUploadPath($size) . $this->picture;
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
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

    public function getNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getPlaceAttribute()
    {
        return $this->city . ($this->country ? ', ' . $this->country->name : '');
    }

    public function getAdminAttribute()
    {
        if ($this->user_role == 'admin') {
            return true;
        }

        return false;
    }

    public static function getProfileSections()
    {
        return [
            'profile' => ['me', 'reviews'],
            'settings' => ['About', 'Photo', 'Address', 'Email', 'Password'],
        ];
    }
}
