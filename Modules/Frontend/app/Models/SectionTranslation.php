<?php

namespace Modules\Frontend\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionTranslation extends Model {
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['section_id', 'lang_code', 'content'];
    protected $casts = [
        'content' => 'array',
    ];
    public function section(): BelongsTo {
        return $this->belongsTo(Section::class, 'section_id');
    }
    /**
     * Accessor to decode JSON content when retrieving.
     */
    public function getContentAttribute($value): object|array|null {
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
}
