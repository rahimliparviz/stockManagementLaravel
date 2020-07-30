<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name',
        'product_code',
        'category_id',
        'supplier_id',
        'root',
        'buying_price',
        'selling_price',
        'buying_date',
        'product_quantity',
        'image'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
