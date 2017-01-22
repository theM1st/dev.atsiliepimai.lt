<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;
use Laravel\Socialite\Contracts\User as ProviderUser;
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

    protected $imageConfig = array(
        'lg' => array('width' => 512, 'fit' => true),
        'md' => array('width' => 256, 'fit' => true),
        'sm' => array('width' => 128, 'fit' => true),
        'xs' => array('width' => 64, 'fit' => true),
    );

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function reviewVotes()
    {
        return $this->hasMany('App\UserReviewVote');
    }

    public function viewedListings()
    {
        return $this->belongsToMany('App\Listing', 'user_listing_viewed')->withPivot('created_at')->withTimestamps();
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function messagesIn()
    {
        return $this->hasMany('App\Message', 'recipient_id');
    }

    public function newMessages()
    {
        return $this->hasMany('App\Message', 'recipient_id')->where('new', 1);
    }

    public function messagesOut()
    {
        return $this->hasMany('App\Message', 'sender_id');
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

    public function reviewVoted($reviewId)
    {
        return $this->reviewVotes()->where('review_id', $reviewId)->exists();
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

    public static function createOrGetSocialUser(ProviderUser $providerUser, $provider)
    {
        $user = User::where('provider_name', $provider)->where('provider_uid', $providerUser->getId())->first();
        
        if ($user) {
            return $user;
        } else {
            list($firstName, $lastName) = explode(' ', $providerUser->getName());

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'provider_name' => $provider,
                    'provider_uid' => $providerUser->getId(),
                    'email' => $providerUser->getEmail(),
                    'username' => ($providerUser->getNickname() ? $providerUser->getNickname() : $firstName),
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'verified' => 1,
                ]);

                if ($providerUser->getAvatar()) {
                    $file = preg_replace('/\?.*/', '', $providerUser->getAvatar());

                    $imageData = file_get_contents($file);

                    $tmpFile = tempnam(sys_get_temp_dir(), 'Auth');
                    $handle = fopen($tmpFile, "w");
                    fwrite($handle, $imageData);
                    fclose($handle);

                    $user->saveFile(basename($file), $tmpFile);

                    $user->picture = basename($file);

                    $user->save();
                }

            } else {
                $user->provider_name = $provider;
                $user->provider_uid = $providerUser->getId();
                $user->save();
            };
        }

        return $user;
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

    public function getDefaultPictureAttribute()
    {
        return ($this->gender == 'female' ? 'female-' : '') . 'default.png';
    }

    public static function getProfileSections()
    {
        return [
            'profile' => ['me', 'reviews', 'questions', 'answers'],
            'settings' => ['About', 'Photo', 'Address', 'Email', 'Password'],
            'messages' => ['create', 'inbox', 'outbox'],
        ];
    }
}
