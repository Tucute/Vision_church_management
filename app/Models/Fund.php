<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = ['name', 'description'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Số dư hiện tại của quỹ = tổng income đã approve - tổng expense đã approve
    public function getBalanceAttribute(): float
    {
        $income = $this->transactions()->where('type', 'income')->where('status', 'approved')->sum('amount');
        $expense = $this->transactions()->where('type', 'expense')->where('status', 'approved')->sum('amount');

        return (float) $income - (float) $expense;
    }
}
