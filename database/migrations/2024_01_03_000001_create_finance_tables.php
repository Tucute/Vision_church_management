<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gộp Income_Category + Expense_Category thành 1 bảng có cột `type`
        // (fix: bản gốc dùng 2 bảng PK riêng -> category_id có thể trùng, không
        // enforce được ở tầng DB việc category phải khớp loại transaction)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['income', 'expense']);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['name', 'type']);
        });

        // Fund = "ví tiền" nơi tiền thực sự nằm, tách biệt rõ với Category
        // (fix: tránh nhầm lẫn "Quỹ truyền giáo" là category hay fund)
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('contributors', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['member', 'external']);
            $table->foreignId('person_id')->nullable()->constrained('people')->nullOnDelete();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']);
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('fund_id')->constrained('funds');
            $table->foreignId('contributor_id')->nullable()->constrained('contributors')->nullOnDelete();
            $table->decimal('amount', 15, 2);
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'status', 'transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('contributors');
        Schema::dropIfExists('funds');
        Schema::dropIfExists('categories');
    }
};
