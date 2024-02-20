<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalData extends Model
{
    use HasFactory;

    // Укажите имя таблицы, связанной с этой моделью
    protected $table = 'additional_data';

    // Укажите поля, доступные для массового заполнения
    protected $fillable = [
        'user_id',
        'activity_1',
        'activity_2',
        'activity_3',
        // Другие поля...
    ];

    // Определите связь с моделью пользователей
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
