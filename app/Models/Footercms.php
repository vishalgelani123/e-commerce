<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footercms extends Model{
    //use SoftDeletes;
    use HasFactory;
    public $table = 'footer_cms';
    protected $fillable = [
        'type',
        'url',
        'title',
        'meta_title',
        'description',
        'meta_description',
        'meta_url',
        'image_or_video',
        'banner_image',
        'position',
        'banner_video',
        'status'
    ];
}
