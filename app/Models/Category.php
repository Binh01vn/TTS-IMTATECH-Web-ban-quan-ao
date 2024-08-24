<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // relationship
    public function parent()
    {
        // danh mục con chỉ có một danh mục cha
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        // danh mục cha có thể có nhiều danh mục con
        return $this->hasMany(Category::class, 'parent_id');
    }
}
