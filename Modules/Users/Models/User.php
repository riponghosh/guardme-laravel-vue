<?php

namespace Modules\Users\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Modules\Account\Traits\UserAccountTrait;
use Modules\App\Models\City;
use Modules\Company\Traits\CompanyUserTrait;
use Modules\Jobs\Traits\JobbableUserTrait;
use Modules\Loyalty\Traits\LoyaltyUserTrait;

use Modules\Users\Helpers\UsersFilter;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable,
        UserAccountTrait,
        JobbableUserTrait,
        CompanyUserTrait,
        LoyaltyUserTrait;

    const STATUS_UNVERIFIED = 1;
    const STATUS_SUSPENDED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_DISAPPROVED = 4;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $dates = [
        'registered_date'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * @return $this
     */
    public function setApiToken()
    {
        $this->api_token = str_random(60);

        return $this;
    }

    /**
     * Get confirmation code on the instance.
     *
     * @return string
     */
    public function getConfirmationCodeAttribute()
    {
        return static::getConfirmationCode($this->email);
    }

    /**
     * Get e-mail confirmation code.
     *
     * @param $email
     *
     * @return string
     */
    static public function getConfirmationCode($email)
    {
        return hash_hmac('sha256', $email, config('app.key'));
    }

    /**
     * Get One Time Password (valid for 5 minutes).
     *
     * @return string
     */
    public function getOTP()
    {
        $now      = Carbon::now();
        $lifetime = 300; // 5 minutes
        $periods  = intdiv($now->timestamp - $now->copy()->startOfDay()->timestamp, $lifetime);
        $unique   = $now->toDateString() . $lifetime * $periods . $this->phone;
        $password = hash_hmac('sha512', $unique, config('app.key'));

        return substr(strtoupper($password), 0, 5);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function getMetadataAttribute($value){
        if($value){
            return json_decode($value, true);
        } else {
            return [];
        }
    }

    public function setPassword($password)
    {
        return $this->update(['password' => bcrypt($password)]);
    }

    public function getAvatarAttribute()
    {
        $avatar = '/assets/img/profile-default.png';

        if (!empty($this->profile_picture)) {
            $avatar = Storage::url('profile-pictures/'. $this->profile_picture);
        }

        return $avatar;
    }

    public function getRoleAttribute()
    {
        return $this->getPrimaryRole()->name;
    }

    public function getSecurityBadgeLinkAttribute()
    {
        $link = null;

        if (!empty($this->security_badge)) {
            $link = '/account/profile/docs/' . $this->security_badge;
        }

        return $link;
    }

    public function getProofOfWorkLinkAttribute()
    {
        $link = null;

        if (!empty($this->proof_of_work)) {
            $link = '/account/profile/docs/' . $this->proof_of_work;
        }

        return $link;
    }

    public function getVisaLinkAttribute()
    {
        $link = null;

        if (!empty($this->visa)) {
            $link = '/account/profile/docs/' . $this->visa;
        }

        return $link;
    }

    public function approve()
    {
        $this->status = static::STATUS_APPROVED;

        $this->save();
    }

    public function disapprove()
    {
        $this->status = static::STATUS_DISAPPROVED;

        $this->save();
    }

    public function suspend()
    {
        $this->status = static::STATUS_SUSPENDED;

        $this->save();
    }

    public function isApproved()
    {
        return $this->status == static::STATUS_APPROVED;
    }

    public function isDisapproved()
    {
        return $this->status == static::STATUS_DISAPPROVED;
    }

    public function scopeVerified($query)
    {
        return $query->where('status', static::STATUS_APPROVED);
    }

    public function scopeUnverified($query)
    {
        return $query->where('status', static::STATUS_UNVERIFIED);
    }

    public function scopeEmployers($query)
    {
        return $query->whereHas('roles', function ($query) {
            return $query->where('name', 'Employer');
        });
    }

    public function scopeSecurity($query)
    {
        return $query->whereHas('roles', function ($query) {
            return $query->where('name', 'Job Seeker');
        });
    }

    public function scopeBetween($query, $dates)
    {
        return $query->whereBetween('registered_date', $dates);
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', static::STATUS_SUSPENDED);
    }

    public function scopeNotSuspended($query)
    {
        return $query->whereIn('status', [static::STATUS_UNVERIFIED, static::STATUS_APPROVED, static::STATUS_DISAPPROVED]);
    }

    public function scopeCategory($query, $id)
    {
        return $query->where('category_id', is_array($id) ? $id[0] : $id);
    }

    public function scopeCountry($query, $id)
    {
        return $query->where('country_id', is_array($id) ? $id[0] : $id);
    }

    public function scopeCity($query, $id)
    {
        return $query->where('city_id', is_array($id) ? $id[0] : $id);
    }

    public function scopeFilter($query, $filters)
    {
        return UsersFilter::filter($query, $filters);
    }

}
