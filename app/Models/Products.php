<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'categorization_id',
        'categories_id',
        'name',
        'slug',
        'sku',
        'product_avatar',
        'price_default',
        'price_sale',
        'discount_percent',
        'start_date',
        'end_date',
        'description',
        'material',
        'user_manual',
        'quantity',
        'views',
        'status',
    ];
    protected $casts = ['status' => 'boolean'];
    public function categorization()
    {
        return $this->belongsTo(Categorization::class);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'id');
    }
    public function tags()
    {
        // n-n
        return $this->belongsToMany(Tags::class, 'product_tag');
    }
    public function galleries()
    {
        // 1-n
        return $this->hasMany(ProductGalleries::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariants::class);
    }
}
