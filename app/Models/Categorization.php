<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorization extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'description'];
    public function categories()
    {
        // n-n
        return $this->belongsToMany(Categories::class, 'category_categorizations', 'categorization_id', 'category_id');
    }
}
