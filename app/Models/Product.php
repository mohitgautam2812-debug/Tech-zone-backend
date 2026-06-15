<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'image',
        'status',
        'category_id',
        'user_id',
        'is_featured',
        'is_active',
        'brand',
        'rating',
        'storage',
        'color',
        'display_size',
        'condition',
        'short_title',
        'sku',
        'warranty',
        'box_contents',
        'key_features',
        'specifications',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }



    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? env('APP_URL') . '/storage/' . $this->image
            : null;
    }

}
