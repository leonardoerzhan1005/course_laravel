<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        // Личные данные (кириллица)
        'last_name_cyrillic',
        'first_name_cyrillic',
        'middle_name_cyrillic',
        
        // Личные данные (латиница)
        'last_name_latin',
        'first_name_latin',
        'middle_name_latin',
        
        // Гражданство
        'is_foreign_citizen',
        
        // Контактная информация
        'email',
        'phone',
        'full_name',
        
        // Образование и работа
        'faculty_id',
        'workplace',
        'country_id',
        'city_id',
        'institution_category',
        'other_institution_type',
        'academic_degree',
        'position',
        'teaching_subjects',
        'not_teaching',
        
        // Курс и даты
        'course_id',
        'specialty_id',
        'course_language',
        'seminar_start_date',
        'seminar_end_date',
        
        // Статус заявки
        'status',
        'notes'
    ];

    protected $casts = [
        'is_foreign_citizen' => 'boolean',
        'not_teaching' => 'boolean',
        'seminar_start_date' => 'date',
        'seminar_end_date' => 'date',
        'teaching_subjects' => 'array',
    ];

    // Аксессоры для полного имени
    public function getFullNameCyrillicAttribute(): string
    {
        return trim($this->last_name_cyrillic . ' ' . $this->first_name_cyrillic . ' ' . $this->middle_name_cyrillic);
    }

    public function getFullNameLatinAttribute(): string
    {
        return trim($this->last_name_latin . ' ' . $this->first_name_latin . ' ' . $this->middle_name_latin);
    }

    // Отношения
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(\Modules\Location\app\Models\Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(\Modules\Location\app\Models\City::class);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialty_id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function courseLanguage(): BelongsTo
    {
        return $this->belongsTo(\Modules\Course\app\Models\CourseLanguage::class, 'course_language');
    }

    // Скоупы
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Мутаторы для валидации
    public function setTeachingSubjectsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['teaching_subjects'] = json_encode(array_filter($value));
        } else {
            $this->attributes['teaching_subjects'] = $value;
        }
    }

    public function setInstitutionCategoryAttribute($value)
    {
        if ($value === 'other' && request()->filled('other_institution_type')) {
            $this->attributes['institution_category'] = request('other_institution_type');
        } else {
            $this->attributes['institution_category'] = $value;
        }
    }
} 



