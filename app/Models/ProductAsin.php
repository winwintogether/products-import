<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAsin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'product_id',
        'asin',
        'country_code'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
