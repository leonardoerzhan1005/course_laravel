<?php

namespace Modules\Frontend\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['home_id', 'name', 'global_content', 'status'];
    protected $casts = [
        'global_content' => 'array',
    ];
    public function getGlobalContentAttribute($value): object|array|null {
        // If the value is already an array (due to casting), return it directly
        if (is_array($value)) {
            return $value;
        }
        
        // If it's a string, try to decode it
        if (is_string($value)) {
            $decoded = json_decode($value);
            // If json_decode fails, return the original value as an array
            return json_last_error() === JSON_ERROR_NONE ? $decoded : ['raw_content' => $value];
        }
        
        // If it's already an object, return it
        if (is_object($value)) {
            return $value;
        }
        
        // Default fallback
        return null;
    }
    
    public function getContentAttribute():object|null {
        return $this->translation?->content;
    }
    public function translation(): ?HasOne {
        return $this->hasOne(SectionTranslation::class)->where('lang_code', getSessionLanguage());
    }

    public function getTranslation($code): ?SectionTranslation {
        return $this->hasOne(SectionTranslation::class)->where('lang_code', $code)->first();
    }

    public function translations(): ?HasMany {
        return $this->hasMany(SectionTranslation::class, 'section_id');
    }
    public function home(): BelongsTo {
        return $this->belongsTo(Home::class, 'home_id');
    }
    public function scopeActive($query) {
        return $query->where('status', 1);
    }
    public function scopeInactive($query) {
        return $query->where('status', 0);
    }

    static function getByName(string $section_name, string $theme_name = DEFAULT_HOMEPAGE) {
        $home = Home::firstOrCreate(['slug' => $theme_name]);
        $section = self::firstOrCreate(['name' => $section_name,'home_id' => $home->id]);
        return $section;
    }
}
