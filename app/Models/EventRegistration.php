<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['event_id', 'person_id', 'status', 'approved_by', 'approved_at'];

    protected $casts = ['approved_at' => 'datetime'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function participant()
    {
        return $this->hasOne(EventParticipant::class, 'registration_id');
    }

    // Approve registration -> tự tạo Event_Participant tương ứng
    // (fix: bản gốc thiếu liên kết giữa 2 bảng này)
    public function approve(User $approver): EventParticipant
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $approver->id,
            'approved_at' => now(),
        ]);

        return $this->participant()->firstOrCreate(
            ['registration_id' => $this->id],
            [
                'event_id' => $this->event_id,
                'participant_type' => 'member',
                'person_id' => $this->person_id,
                'name' => $this->person->name,
                'phone' => $this->person->phone,
                'email' => $this->person->email,
                'status' => 'approved',
            ]
        );
    }

    public function reject(User $approver): void
    {
        $this->update([
            'status' => 'rejected',
            'approved_by' => $approver->id,
            'approved_at' => now(),
        ]);
    }
}
