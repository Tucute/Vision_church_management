<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmallGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'leader_person_id', 'meeting_schedule', 'location'];

    public function leader()
    {
        return $this->belongsTo(Person::class, 'leader_person_id');
    }

    public function memberships()
    {
        return $this->hasMany(SmallGroupMembership::class);
    }

    public function activeMemberships()
    {
        return $this->hasMany(SmallGroupMembership::class)->whereNull('left_date');
    }

    public function members()
    {
        return $this->belongsToMany(Person::class, 'small_group_memberships')
            ->withPivot(['joined_date', 'left_date'])
            ->withTimestamps();
    }
}