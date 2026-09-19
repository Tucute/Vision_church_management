<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'location',
        'registration_start', 'registration_end', 'capacity',
        'registration_required', 'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'registration_required' => 'boolean',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function approvedParticipants()
    {
        return $this->hasMany(EventParticipant::class)->where('status', 'approved');
    }

    public function getRemainingCapacityAttribute(): ?int
    {
        if (is_null($this->capacity)) {
            return null;
        }

        return max(0, $this->capacity - $this->approvedParticipants()->count());
    }

    public function getIsFullAttribute(): bool
    {
        return ! is_null($this->capacity) && $this->remaining_capacity <= 0;
    }
}
