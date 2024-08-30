<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'image',
    ];
}
