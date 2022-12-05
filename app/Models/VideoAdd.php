<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoAdd extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'videoadd';

   
    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'video',
        'status',
        'created_at',
        'updated_at',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')->fit('crop', 50, 50);
    //     $this->addMediaConversion('preview')->fit('crop', 120, 120);
    // }

    // public function getImageAttribute()
    // {
    //     $file = [];

    //     if ($this->image) {
    //         $file['url'] = asset("storage/slider/$this->image");
    //         $file['thumbnail'] = asset("storage/slider/thumb/$this->image");
    //     }

    //     return (object) $file;
    // }

  

}
