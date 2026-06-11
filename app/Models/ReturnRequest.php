<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    protected $table = 'returns'; // matches your actual DB table

    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'description',
        'image',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'return_id');
    }

}
