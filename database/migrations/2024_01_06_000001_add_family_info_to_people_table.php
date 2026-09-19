<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {
            // Bối cảnh gia đình - textarea tự do
            $table->text('family_background')->nullable()->after('occupation');

            // Tình trạng mối quan hệ - option cố định
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])
                ->nullable()
                ->after('family_background');
        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['family_background', 'marital_status']);
        });
    }
};