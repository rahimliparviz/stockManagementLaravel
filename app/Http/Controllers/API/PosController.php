<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use DateTime;

class PosController extends Controller
{
    public function GetProduct($id){

        $product = Product::where('category_id',$id)
            ->get();
        return response()->json($product);

    }

    public function order(Request $request){

//        dd($request->all());
        $validatedData = $request->validate([
            'customerId' => 'required',
            'payBy' => 'required',
        ]);


        $order = Order::create([
            'customer_id' => $request->customerId,
            'quantity' => $request->productsQuantity,
            'sub_total' => $request->subtotal,
            'vat' => $request->vat,
            'total' => $request->total,
            'pay' => $request->pay,
            'due' => $request->due,
            'payby' => $request->payBy,
            'order_date' => date('d/m/Y'),
            'order_month' => date('F'),
            'order_year' => date('Y')
            ]);
//        $data['customer_id'] = $request->customerId;
//        $data['quantity'] = $request->productsQuantity;
//        $data['sub_total'] = $request->subtotal;
//        $data['vat'] = $request->vat;
//        $data['total'] = $request->total;
//        $data['pay'] = $request->pay;
//        $data['due'] = $request->due;
//        $data['payby'] = $request->payBy;
//        $data['order_date'] = date('d/m/Y');
//        $data['order_month'] = date('F');
//        $data['order_year'] = date('Y');
//        $order_id = DB::table('orders')->insertGetId($data);

        $orderProducts = DB::table('pos')->get();

        foreach ($orderProducts as $orderProduct) {
            $newOrderProduct = new OrderProduct();
            $newOrderProduct->order_id = $order->id;
            $newOrderProduct->product_id = $orderProduct->product_id;
            $newOrderProduct->product_quantity = $orderProduct->product_quantity;
            $newOrderProduct->product_price = $orderProduct->product_price;
            $newOrderProduct->sub_total = $orderProduct->sub_total;
            $newOrderProduct->save();


            $product = Product::find($orderProduct->product_id);
            $product->product_quantity-=1;
            $product->save();
        }
        DB::table('pos')->delete();
        return response('Done');

    }


    public function ordersByDate(Request $request){
        $orderdate = $request->date;
        $newdate = new DateTime($orderdate);
        $done = $newdate->format('d/m/Y');

        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->select('customers.name','orders.*')
            ->where('orders.order_date',$done)
            ->get();

        return response()->json($order);

    }



    public function TodaySell(){
        $date = date('d/m/Y');
        $sell = Order::where('order_date',$date)->get()->sum('total');
        return response()->json($sell);
    }

    public function TodayIncome(){
        $date = date('d/m/Y');
        $income =Order::where('order_date',$date)->get()->sum('pay');
        return response()->json($income);
    }

    public function TodayDue(){
        $date = date('d/m/Y');
        $todaydue =Order::where('order_date',$date)->get()->sum('due');
        return response()->json($todaydue);
    }


    public function TodayExpense(){
        $date = date('d/m/Y');
        $expense = Expense::where('expense_date',$date)->get()->sum('amount');
        return response()->json($expense);
    }

    public function Stockout(){

        $product = Product::where('product_quantity','<','1')->get();
        return response()->json($product);

    }


}
