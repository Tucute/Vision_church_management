<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryRole extends Model
{
    protected $fillable = ['name'];

    public function memberships()
    {
        return $this->hasMany(MinistryMembership::class);
    }
}
