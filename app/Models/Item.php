<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_description',
        'item_price',

        'item_stock_quantity',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsToMany(Product::class, 'item_product');
    }
}
