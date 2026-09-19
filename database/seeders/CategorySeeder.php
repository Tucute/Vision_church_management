<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $income = ['Dâng hiến', 'Quyên góp', 'Nộp phí sự kiện', 'Quỹ truyền giáo', 'Quỹ chung Hội Thánh', 'Thu khác'];
        $expense = ['Chi phí sự kiện', 'Chi phí vận hành', 'Hỗ trợ truyền giáo', 'Chi khác'];

        foreach ($income as $name) {
            Category::firstOrCreate(['name' => $name, 'type' => 'income']);
        }

        foreach ($expense as $name) {
            Category::firstOrCreate(['name' => $name, 'type' => 'expense']);
        }
    }
}
