<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryMembership extends Model
{
    protected $fillable = ['person_id', 'ministry_id', 'ministry_role_id', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function role()
    {
        return $this->belongsTo(MinistryRole::class, 'ministry_role_id');
    }

    public function endService(): void
    {
        $this->update(['end_date' => now()]);
    }

    public function getIsActiveAttribute(): bool
    {
        return is_null($this->end_date);
    }
}
