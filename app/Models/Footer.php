<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'footers';
    protected $fillable = [
        'text'
    ];
    
}
