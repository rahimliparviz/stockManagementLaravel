<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'quantity',
        'sub_total',
        'vat' ,
        'total',
        'pay',
        'due',
        'payBy',
        'order_date',
        'order_month',
        'order_year'];
}
