<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function orders(Request $request){

        $date = $request->date? Carbon::parse($request->date)  :Carbon::today();

        $orders = Order::with('customer:id,name')
            ->whereDate('created_at', $date)
            ->get();

        return response()->json($orders);
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
