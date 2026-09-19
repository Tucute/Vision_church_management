<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Small Group (nhóm tế bào/nhóm gia đình) khác Ministry (ban ngành phục vụ)
        Schema::create('small_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('leader_person_id')->nullable()->constrained('people')->nullOnDelete();
            $table->string('meeting_schedule')->nullable(); // vd: "Thứ 5 hàng tuần, 19:30"
            $table->string('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('small_group_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('small_group_id')->constrained('small_groups')->cascadeOnDelete();
            $table->foreignId('person_id')->constrained('people')->cascadeOnDelete();
            $table->date('joined_date');
            $table->date('left_date')->nullable(); // NULL = đang tham gia (cùng rule với ministry_memberships)
            $table->timestamps();

            $table->index(['small_group_id', 'person_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('small_group_memberships');
        Schema::dropIfExists('small_groups');
    }
};