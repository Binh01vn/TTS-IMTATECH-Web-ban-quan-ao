<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'colorValue',
    ];
    public function variantValues(){
        return $this->hasMany(VariantValue::class, 'color_attribute_id');
    }
}
