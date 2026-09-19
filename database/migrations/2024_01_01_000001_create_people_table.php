<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('hometown')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            // Person Type: tách riêng khỏi Member Status (fix điểm ambiguous trong spec gốc)
            $table->enum('person_type', ['newcomer', 'member'])->default('newcomer');

            // Chỉ có giá trị khi person_type = member
            $table->enum('member_status', ['active', 'inactive'])->nullable();

            // Ngày trở thành Member (bị thiếu trong ERD gốc)
            $table->date('member_since')->nullable();

            // Nếu Newcomer bị từ chối, lưu lý do thay vì xoá cứng
            $table->string('rejection_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['person_type', 'member_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
