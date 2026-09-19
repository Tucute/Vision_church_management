<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['subject', 'time', 'location', 'description', 'status', 'created_by', 'published_at'];

    protected $casts = [
        'time' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function publish(): void
    {
        $this->update(['status' => 'published', 'published_at' => now()]);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
