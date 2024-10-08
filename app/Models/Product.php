<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'image_thumbnail',
        'price_default',
        'price_sale',
        'sale_percent',
        'start_date',
        'end_date',
        'description',
        'material',
        'user_manual',
        'quantity',
        'views',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function category()
    {
        // 1 product(sản phẩm) thuộc về 1 category(danh mục) (quan hệ 1-1)
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        // 1 product có nhiều reviews
        return $this->hasMany(Review::class);
    }
    public function galleries()
    {
        // quan he 1-n
        return $this->hasMany(ProductGallery::class);
    }
    public function variants()
    {
        // quan he 1-n
        return $this->hasMany(ProductVariant::class);
    }
    public function tags()
    {
        // quan he n-n
        return $this->belongsToMany(Tag::class);
    }
}
