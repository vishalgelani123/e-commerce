<?php
namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weight extends Model
{
    use HasFactory;
    public $table = 'weight_range';

    protected $fillable = [
        'weight_from',
        'weight_to',
        'created_at',
        'updated_at',
    ];
}
