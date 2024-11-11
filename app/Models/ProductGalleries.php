<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalleries extends Model
{
    use HasFactory;
    protected $fillable = ['products_id', 'path_images'];
}
