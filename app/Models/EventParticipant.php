<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $fillable = [
        'event_id', 'registration_id', 'participant_type', 'person_id',
        'name', 'phone', 'email', 'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registration()
    {
        return $this->belongsTo(EventRegistration::class, 'registration_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class, 'participant_id');
    }
}
