<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prayer_requests', function (Blueprint $table) {
            $table->id();
            // Nullable để hỗ trợ gửi ẩn danh nếu cần sau này
            $table->foreignId('person_id')->nullable()->constrained('people')->nullOnDelete();
            $table->text('content');
            // true = hiển thị cho cả cộng đồng cùng cầu nguyện, false = chỉ Admin/bản thân thấy
            $table->boolean('is_public')->default(false);
            $table->boolean('is_answered')->default(false);
            $table->text('answered_note')->nullable();
            $table->timestamps();

            $table->index(['is_public', 'is_answered']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_requests');
    }
};