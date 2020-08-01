<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->format('Y-m-d');;
    }


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}
