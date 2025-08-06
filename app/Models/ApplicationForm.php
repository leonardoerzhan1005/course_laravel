<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        
        // Образование и работа
        'course_direction',
        'workplace',
        'country_id',
        'city_id',
        'institution_category',
        'other_institution_type',
        'academic_degree',
        'position',
        'teaching_subjects',
        
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
        'seminar_start_date' => 'date',
        'seminar_end_date' => 'date',
        'teaching_subjects' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(\Modules\Location\app\Models\Country::class);
    }

    public function city()
    {
        return $this->belongsTo(\Modules\Location\app\Models\City::class);
    }

    public function courseLevel()
    {
        return $this->belongsTo(\Modules\Course\app\Models\CourseLevel::class, 'specialty_id');
    }

    public function courseLanguage()
    {
        return $this->belongsTo(\Modules\Course\app\Models\CourseLanguage::class, 'course_language');
    }
} 