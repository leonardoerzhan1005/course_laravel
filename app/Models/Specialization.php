<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Specialization extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'faculty_id',
        'name_ru',
        'name_kz',
        'name_en',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
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

    // Скоуп для активных специализаций
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // Скоуп для специализаций конкретного факультета
    public function scopeByFaculty($query, $facultyId)
    {
        return $query->where('faculty_id', $facultyId);
    }
}
