<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footerlink extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'footerlinks';
    protected $fillable = [
        'title','url','footer_id','footer_name'
    ];
    
}
