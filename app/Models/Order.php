<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type_of_work',
        'address',
        'distance',
        'price_per_hour',
        'duration',
        'payment_form',
        'additional_info',
        'latitude',  
        'longitude',
    ];

    // Остальная часть модели...
}
