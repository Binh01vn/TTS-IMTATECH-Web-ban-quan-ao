<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariants extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'products_id',
        'color_attributes_id',
        'size_attributes_id',
        'price_default',
        'price_sale',
        'start_date',
        'end_date',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
    public function color()
    {
        return $this->belongsTo(ColorAttributes::class, 'color_attributes_id', 'id');
    }
    public function size()
    {
        return $this->belongsTo(SizeAttributes::class, 'size_attributes_id', 'id');
    }
}
