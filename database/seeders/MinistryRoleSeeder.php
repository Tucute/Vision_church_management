<?php

namespace Database\Seeders;

use App\Models\MinistryRole;
use Illuminate\Database\Seeder;

class MinistryRoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Trưởng ban', 'Phó ban', 'Thành viên'] as $name) {
            MinistryRole::firstOrCreate(['name' => $name]);
        }
    }
}
