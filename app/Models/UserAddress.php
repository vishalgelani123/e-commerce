<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table="user_addresses";
    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'address_type',
        'country_id',
        'state_id',
        'city',
        'area',
        'house',
        'landmark',
        'pincode',
        'by_default',
    ];

    // public function setNameAttribute($value)
    // {
    //     if($value == 'on'){
    //         $value= 1;
    //     }else{
    //         $value= 0;
    //     }
    //     $this->attributes['by_default'] = $value;
    // }

    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }

}
