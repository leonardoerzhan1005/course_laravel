<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationLanguage extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name_ru',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'study_language', 'code');
    }

    // Константы для языков
    const CODE_KK = 'kk';
    const CODE_RU = 'ru';
    const CODE_EN = 'en';

    // Аксессор для получения названия языка
    public function getNameAttribute(): string
    {
        return $this->name_ru;
    }

    // Скоуп для получения языков по кодам
    public function scopeByCodes($query, array $codes)
    {
        return $query->whereIn('code', $codes);
    }
}
