<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesaleUser extends Model
{
    use HasFactory;

    protected $table = 'wholesale_users';

    protected $fillable = [
       'name',
       'email',
       'mobile',
       'password',
       'status',
       'location',
       'description',
       'created_at',
       'updated_at'
    ];
}
