<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = ['person_id', 'name', 'email', 'password', 'role', 'status'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Chỉ admin/approver được vào Filament admin panel
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'approver']) && $this->status === 'active';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isApprover(): bool
    {
        return in_array($this->role, ['admin', 'approver']);
    }
}
