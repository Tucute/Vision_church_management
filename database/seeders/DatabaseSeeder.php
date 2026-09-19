<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MinistryRoleSeeder::class,
            CategorySeeder::class,
            AdminUserSeeder::class,
            DemoSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}