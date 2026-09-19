<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    protected $fillable = ['participant_id', 'status', 'attendance_date'];

    protected $casts = ['attendance_date' => 'date'];

    public function participant()
    {
        return $this->belongsTo(EventParticipant::class, 'participant_id');
    }

    // event() truy cập gián tiếp qua participant, tránh cột event_id dư thừa
    public function event()
    {
        return $this->participant->event();
    }
}
