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

    // Phân quyền theo từng panel: Admin panel chỉ dành cho staff,
    // Community panel dành cho mọi tài khoản đang active (kể cả admin/approver
    // vì họ cũng là giáo dân, có thể muốn dùng tính năng cộng đồng như Member).
    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        return match ($panel->getId()) {
            'admin' => in_array($this->role, ['admin', 'approver']),
            'community' => true,
            default => false,
        };
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