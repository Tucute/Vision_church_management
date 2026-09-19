<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->dateTime('time')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Bảng cấu hình 1 dòng duy nhất (singleton) - thông tin giới thiệu Hội Thánh
        Schema::create('church_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('history')->nullable();
            $table->json('contact_info')->nullable();
            $table->json('social_links')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_info');
        Schema::dropIfExists('notifications');
    }
};
