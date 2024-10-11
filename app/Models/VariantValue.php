<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;
    protected $fillable = ['product_variant_id', 'color_attribute_id', 'size_attribute_id', 'color_value', 'size_value'];
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function colorAttribute()
    {
        return $this->belongsTo(ColorAttribute::class, 'color_attribute_id');
    }

    public function sizeAttribute()
    {
        return $this->belongsTo(SizeAttribute::class, 'size_attribute_id');
    }
}
