<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Transaction extends Model
{
    protected $fillable = [
        'type', 'category_id', 'fund_id', 'contributor_id', 'amount',
        'description', 'transaction_date', 'status', 'created_by',
        'approved_by', 'approved_at',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'approved_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        // Đảm bảo category.type luôn khớp transaction.type ở tầng ứng dụng,
        // vì 1 bảng categories dùng chung cho cả 2 loại (không thể ràng buộc
        // bằng FK riêng như thiết kế 2-bảng ban đầu).
        static::saving(function (Transaction $transaction) {
            $category = $transaction->category ?? Category::find($transaction->category_id);

            if ($category && $category->type !== $transaction->type) {
                throw ValidationException::withMessages([
                    'category_id' => "Category '{$category->name}' thuộc loại {$category->type}, không khớp với transaction type {$transaction->type}.",
                ]);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function approve(User $approver): void
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $approver->id,
            'approved_at' => now(),
        ]);
    }

    public function reject(User $approver): void
    {
        $this->update([
            'status' => 'rejected',
            'approved_by' => $approver->id,
            'approved_at' => now(),
        ]);
    }
}
