<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Performer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        // Убедитесь, что вы включили все поля, которые вы хотите массово назначить.
        'latitude',
        'longitude',
        'is_online', // добавьте это поле для отслеживания статуса онлайн
        // Добавьте другие поля, которые нужны для вашей модели.
    ];
}
