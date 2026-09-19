<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $fillable = ['type', 'person_id', 'name', 'phone', 'email'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
