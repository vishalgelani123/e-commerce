<?php
namespace App\Models;

use \DateTimeInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;
    public $table = 'pincode_shipping';

    protected $fillable = [
        'ps_pincode',
        'ps_weight_id',
        'ps_price',
        'created_at',
        'updated_at',
    ];
}
