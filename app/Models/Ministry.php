<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ministry extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function memberships()
    {
        return $this->hasMany(MinistryMembership::class);
    }

    public function activeMemberships()
    {
        return $this->hasMany(MinistryMembership::class)->whereNull('end_date');
    }

    public function members()
    {
        return $this->belongsToMany(Person::class, 'ministry_memberships')
            ->withPivot(['ministry_role_id', 'start_date', 'end_date'])
            ->withTimestamps();
    }
}
