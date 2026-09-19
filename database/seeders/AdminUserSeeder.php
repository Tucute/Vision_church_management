<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@church.local'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // đổi ngay sau khi deploy
                'role' => 'admin',
                'status' => 'active',
            ]
        );
    }
}
