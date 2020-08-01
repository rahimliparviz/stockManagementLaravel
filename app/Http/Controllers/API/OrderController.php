<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function orders(Request $request)
    {

        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();

        $orders = Order::with('customer:id,name')
            ->whereDate('created_at', $date)
            ->get();

        return response()->json($orders);
    }

    public function addOrder(Request $request){

        $validatedData = $request->validate([
            'customerId' => 'required',
            'payBy' => 'required',
            'pay' => 'required',

        ]);

        $order = Order::create([
            'customer_id' => $request->customerId,
            'quantity' => $request->productsQuantity,
            'price' => $request->price,
            'price_with_vat' => $request->priceWithVat,
            'pay' => $request->pay,
            'due' => $request->due,
            'payBy' => $request->payBy,
        ]);
        ;

        $orderProducts = $request->orderProducts;

        foreach ($orderProducts as $orderProduct) {
            $newOrderProduct = new OrderProduct();
            $newOrderProduct->order_id = $order['id'];
            $newOrderProduct->product_id = $orderProduct['id'];
            $newOrderProduct->quantity = $orderProduct['selected_quantity'];
            $newOrderProduct->price = $orderProduct['selling_price'] * $orderProduct['selected_quantity'];
            $newOrderProduct->save();


            $product = Product::find($orderProduct['id']);
            $product->product_quantity-=$newOrderProduct->quantity;
            $product->save();
        }

        return response(['status'=>'success','message'=>'Order is done!']);

    }


    public function order($id)
    {

        $order = Order::with('customer', 'orderProducts.product')->find($id);

        return response()->json($order);

    }


}
