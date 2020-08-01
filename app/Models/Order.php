<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'quantity',
        'price',
        'vat' ,
        'price_with_vat',
        'pay',
        'due',
        'payBy',
        'order_date',
       ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
