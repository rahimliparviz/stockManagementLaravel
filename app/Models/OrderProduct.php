<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $hidden = ["created_at",'updated_at'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
