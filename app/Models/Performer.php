<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    use HasFactory;

    protected $fillable = [
        // Убедитесь, что вы включили все поля, которые вы хотите массово назначить.
        'latitude',
        'longitude',
        // Добавьте другие поля, которые нужны для вашей модели.
    ];
}
