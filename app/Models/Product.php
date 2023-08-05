<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id', 'quantity', 'descrip', 'size_id'];

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with images
    public function images()
    {
        return $this->hasOne(Image::class, 'product_id');
    }

    // Relationship with sizes
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}

