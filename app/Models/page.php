<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_name',
        'slug',
        'content',
    ];
    // demo

    protected $casts = [
        'content' => 'array'
    ];
}