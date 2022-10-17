<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'sku',
        'fdw_sku',
        'stock',
        'cog',
        'price',
        'length',
        'width',
        'height',
        'weight'
    ];

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function asins()
    {
        return $this->hasMany(ProductAsin::class);
    }
}
