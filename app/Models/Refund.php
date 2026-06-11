<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds';

    protected $fillable = [
        'return_id',
        'order_id',
        'user_id',
        'refund_amount',
        'refund_method',
        'transaction_id',
        'bank_account_number',
        'bank_ifsc',
        'upi_id',
        'status',
        'admin_notes',
        'failure_reason',
        'processed_at',
        'completed_at',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'processed_at'  => 'datetime',
        'completed_at'  => 'datetime',
    ];

      public function returnRequest()
    {
        return $this->belongsTo(ReturnRequest::class, 'return_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

 

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getFormattedAmountAttribute(): string
    {
      return "₹" . number_format($this->refund_amount ?? 0, 2);
    }
}