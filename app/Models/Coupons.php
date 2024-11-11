<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    const DISCOUNT_TYPE = [
        'percent' => 'Giảm giá phần trăm (%)',
        'fixed' => 'Giảm giá cố định',
    ];
    protected $fillable = [
        'name',
        'code',
        'description',
        'discount_type',
        'discount_amount',
        'minimum_spend',
        'maximum_spend',
        'start_date',
        'end_date',
        'quantity',
        'quantity_received',
        'quantity_used',
        'status_coupon',
    ];
    protected $casts = [
        'status_coupon' => 'boolean',
    ];
}
