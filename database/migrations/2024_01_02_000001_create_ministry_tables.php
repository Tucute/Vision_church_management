<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ministries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Lookup table thay vì enum cứng 3 role (fix: dễ thêm role mới sau này)
        Schema::create('ministry_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Trưởng ban, Phó ban, Thành viên, ...
            $table->timestamps();
        });

        Schema::create('ministry_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->cascadeOnDelete();
            $table->foreignId('ministry_id')->constrained('ministries')->cascadeOnDelete();
            $table->foreignId('ministry_role_id')->constrained('ministry_roles');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL = đang phục vụ (rule tường minh)
            $table->timestamps();

            $table->index(['person_id', 'ministry_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ministry_memberships');
        Schema::dropIfExists('ministry_roles');
        Schema::dropIfExists('ministries');
    }
};
