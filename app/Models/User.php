<?php

namespace App\Models;

use \DateTimeInterface;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use SoftDeletes;
    use Notifiable;
    use HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'provider',
        'provider_id',
        'mobile',
        'address',
        'address2',
        'city_id',
        'state',
        'country',
        'postcode',
        'ref_status',
        'referral_code',
        'google_id',
        'customer_type_id',
        'company_name',
        'gst_no',
        'status',
    ];

    public const STATUS_SELECT = [
        '1' => 'Approve',
        '0' => 'Reject',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function stat()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function cntry()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    
    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }

    public function userOrders()
    {
        return $this->hasMany(UserOrder::class);
    }

}
