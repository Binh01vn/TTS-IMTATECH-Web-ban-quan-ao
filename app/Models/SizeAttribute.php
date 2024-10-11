<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'sizeValue',
    ];
    public function variantValues(){
        return $this->hasMany(VariantValue::class, 'size_attribute_id');
    }
}
