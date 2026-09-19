<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallGroupMembership extends Model
{
    protected $fillable = ['small_group_id', 'person_id', 'joined_date', 'left_date'];

    protected $casts = [
        'joined_date' => 'date',
        'left_date' => 'date',
    ];

    public function smallGroup()
    {
        return $this->belongsTo(SmallGroup::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function leaveGroup(): void
    {
        $this->update(['left_date' => now()]);
    }

    public function getIsActiveAttribute(): bool
    {
        return is_null($this->left_date);
    }
}