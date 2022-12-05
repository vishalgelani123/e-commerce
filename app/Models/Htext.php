<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Htext extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'header_text';

   
    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'text',
        'status',
        'created_at',
        'updated_at',
    ];

}
