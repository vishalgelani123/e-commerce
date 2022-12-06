<?php

namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tlider extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public $table = 'tliders';

    protected $appends = [
        'photo',
    ];

    protected $hidden = [
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'url',
        'image',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getPhotoAttribute() {
        $file = [];

        if ($this->image) {
            $file['url'] = asset("file/$this->image");
            $file['thumb'] = asset("file/$this->image");

        }

        return (object) $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
