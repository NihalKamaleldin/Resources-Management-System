<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'product_name',
        'product_code',
        'stock',
        'product_price',
        'product_image',
        'items',
    ];

    public $sortable = [
        'product_name',
        'product_code',
        'stock',
        'product_price',
        'product_image',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'items',
    ];
    public function items()
{
    return $this->belongsToMany(Item::class, 'item_product');
}
protected $casts = [
    'product_code' => 'string',
];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('product_name', 'like', '%' . $search . '%');
        });
    }
}
