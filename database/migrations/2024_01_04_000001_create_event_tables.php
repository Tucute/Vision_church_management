<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location')->nullable();
            $table->dateTime('registration_start')->nullable();
            $table->dateTime('registration_end')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('registration_required')->default(true);
            $table->enum('status', ['draft', 'open', 'closed', 'completed', 'cancelled'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });

        // Đơn đăng ký do chính Person gửi (chỉ áp dụng cho người đã có trong hệ thống)
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('person_id')->constrained('people')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'person_id']);
        });

        // Danh sách tham dự thực tế: có thể tạo từ 1 registration được approve,
        // hoặc admin thêm tay (kể cả khách ngoài - external, không cần tài khoản)
        // (fix: bản gốc không có FK nối Registration <-> Participant)
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('registration_id')->nullable()->constrained('event_registrations')->nullOnDelete();
            $table->enum('participant_type', ['member', 'external']);
            $table->foreignId('person_id')->nullable()->constrained('people')->nullOnDelete();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['approved', 'rejected', 'cancelled'])->default('approved');
            $table->timestamps();
        });

        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id();
            // Bỏ event_id trùng lặp so với bản gốc - lấy qua participant->event_id
            $table->foreignId('participant_id')->constrained('event_participants')->cascadeOnDelete();
            $table->enum('status', ['present', 'absent']);
            $table->date('attendance_date');
            $table->timestamps();

            $table->unique(['participant_id', 'attendance_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_attendances');
        Schema::dropIfExists('event_participants');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};
