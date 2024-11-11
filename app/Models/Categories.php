<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'description'];
    public function categorizations()
    {
        // n-n
        return $this->belongsToMany(Categorization::class, 'category_categorizations', 'category_id', 'categorization_id');
    }
}
