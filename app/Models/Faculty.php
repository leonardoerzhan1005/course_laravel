<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Faculty extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name_ru',
        'name_kz',
        'name_en',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the auto-incrementing ID type.
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the data type of the auto-incrementing ID.
     */
    public function getKeyType()
    {
        return 'string';
    }

    public function specializations(): HasMany
    {
        return $this->hasMany(Specialization::class);
    }

    public function courses(): HasManyThrough
    {
        return $this->hasManyThrough(Course::class, Specialization::class);
    }

    // Аксессоры для получения названий на разных языках
    public function getNameAttribute(): string
    {
        $locale = app()->getLocale();
        
        return match($locale) {
            'kk' => $this->name_kz,
            'en' => $this->name_en,
            default => $this->name_ru,
        };
    }

    // Скоуп для активных факультетов
    public function scopeActive($query)
    {
        return $query->orderBy('sort_order');
    }
}
