<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['product_id', 'img1', 'img2', 'img3'];

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}
