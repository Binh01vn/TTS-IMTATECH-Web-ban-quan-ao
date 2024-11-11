<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'products_id',
        'user_name',
        'rating',
        'comment',
        'review_date',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
