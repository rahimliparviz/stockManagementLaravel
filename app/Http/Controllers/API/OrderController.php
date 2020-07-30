<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function todaysOrders(){

        $data = date('d/m/Y');
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('order_date',$data)
            ->select('customers.name','orders.*')
            ->orderBy('orders.id','DESC')->get();
        return response()->json($order);
    }


    public function order($id){
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.id',$id)
            ->select('customers.name','customers.phone','customers.address','orders.*')
            ->first();
        return response()->json($order);

    }


    public function OrderPruducts($id){

        $details = DB::table('order_products')
            ->join('products','order_products.product_id','products.id')
            ->where('order_products.order_id',$id)
            ->select('products.product_name','products.product_code','products.image','order_products.*')
            ->get();
        return response()->json($details);


    }



}
