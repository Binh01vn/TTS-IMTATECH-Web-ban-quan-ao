<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function values(){
        // quan he 1-n
        return $this->hasMany(AttributeValue::class);
    }
}
