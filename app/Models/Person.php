<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'gender', 'date_of_birth', 'hometown', 'occupation',
        'family_background', 'marital_status',
        'phone', 'email', 'address', 'person_type', 'member_status',
        'member_since', 'rejection_reason',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'member_since' => 'date',
    ];

    // Age tính động, không lưu trong DB (tránh dữ liệu lệch theo thời gian)
    protected $appends = ['age'];

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->age;
    }

    public function ministryMemberships()
    {
        return $this->hasMany(MinistryMembership::class);
    }

    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'ministry_memberships')
            ->withPivot(['ministry_role_id', 'start_date', 'end_date'])
            ->withTimestamps();
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function contributorProfile()
    {
        return $this->hasOne(Contributor::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Approve: Newcomer -> Member
    public function approveAsMember(array $memberData, User $approver): void
    {
        $this->update(array_merge($memberData, [
            'person_type' => 'member',
            'member_status' => 'active',
            'member_since' => $memberData['member_since'] ?? now(),
        ]));
    }

    public function rejectNewcomer(string $reason): void
    {
        $this->update(['rejection_reason' => $reason]);
    }

    public function scopeNewcomers($query)
    {
        return $query->where('person_type', 'newcomer');
    }

    public function scopeMembers($query)
    {
        return $query->where('person_type', 'member');
    }
}