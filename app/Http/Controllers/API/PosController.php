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
