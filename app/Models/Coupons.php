<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_amount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'minimum_spend',
        'maximum_spend',
        'individual_use',
        'exclude_sale_items',
    ];

    protected $cats = [
        'individual_use' => 'boolean',
        'exclude_sale_items' => 'boolean',
    ];
}
