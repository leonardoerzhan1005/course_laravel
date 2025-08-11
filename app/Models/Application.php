<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name_cyr',
        'full_name_lat',
        'is_foreign_citizen',
        'desired_track_id',
        'employer_country',
        'employer_city',
        'employer_category',
        'degree',
        'position',
        'specialty',
        'taught_subjects',
        'contact_email',
        'contact_phone',
        'desired_course_text',
        'specialization_id',
        'seminar_date_from',
        'seminar_date_to',
        'study_language',
        'login',
        'status',
    ];

    protected $casts = [
        'is_foreign_citizen' => 'boolean',
        'seminar_date_from' => 'date',
        'seminar_date_to' => 'date',
        'taught_subjects' => 'array',
    ];

    // Константы для статусов
    const STATUS_DRAFT = 'draft';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_IN_REVIEW = 'in_review';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Константы для категорий работодателей
    const EMPLOYER_CATEGORY_VUZ = 'vuz';
    const EMPLOYER_CATEGORY_SCHOOL = 'school';
    const EMPLOYER_CATEGORY_COLLEGE = 'college';
    const EMPLOYER_CATEGORY_OTHER = 'other';

    // Константы для языков обучения
    const STUDY_LANGUAGE_KK = 'kk';
    const STUDY_LANGUAGE_RU = 'ru';
    const STUDY_LANGUAGE_EN = 'en';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function desiredTrack(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'desired_track_id');
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function educationLanguage(): BelongsTo
    {
        return $this->belongsTo(EducationLanguage::class, 'study_language', 'code');
    }

    // Аксессоры для получения названий
    public function getEmployerCategoryNameAttribute(): string
    {
        $categories = [
            self::EMPLOYER_CATEGORY_VUZ => 'ВУЗ',
            self::EMPLOYER_CATEGORY_SCHOOL => 'Школа',
            self::EMPLOYER_CATEGORY_COLLEGE => 'Колледж',
            self::EMPLOYER_CATEGORY_OTHER => 'Другое',
        ];

        return $categories[$this->employer_category] ?? 'Неизвестно';
    }

    public function getStatusNameAttribute(): string
    {
        $statuses = [
            self::STATUS_DRAFT => 'Черновик',
            self::STATUS_SUBMITTED => 'Отправлена',
            self::STATUS_IN_REVIEW => 'На рассмотрении',
            self::STATUS_APPROVED => 'Одобрена',
            self::STATUS_REJECTED => 'Отклонена',
        ];

        return $statuses[$this->status] ?? 'Неизвестно';
    }

    public function getStudyLanguageNameAttribute(): string
    {
        $languages = [
            self::STUDY_LANGUAGE_KK => 'Казахский',
            self::STUDY_LANGUAGE_RU => 'Русский',
            self::STUDY_LANGUAGE_EN => 'Английский',
        ];

        return $languages[$this->study_language] ?? 'Неизвестно';
    }

    // Скоупы для фильтрации
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByForeignCitizen($query, $isForeign)
    {
        return $query->where('is_foreign_citizen', $isForeign);
    }

    public function scopeByStudyLanguage($query, $language)
    {
        return $query->where('study_language', $language);
    }
}
