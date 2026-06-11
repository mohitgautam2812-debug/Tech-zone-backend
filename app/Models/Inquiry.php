<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'phone',      
        'city',       
        'purpose',  
        'budget',     
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()     
    {
        return $this->belongsTo(Product::class);
    }
}