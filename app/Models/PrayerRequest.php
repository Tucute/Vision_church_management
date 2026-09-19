<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    protected $fillable = ['person_id', 'content', 'is_public', 'is_answered', 'answered_note'];

    protected $casts = [
        'is_public' => 'boolean',
        'is_answered' => 'boolean',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function markAnswered(?string $note = null): void
    {
        $this->update(['is_answered' => true, 'answered_note' => $note]);
    }
}