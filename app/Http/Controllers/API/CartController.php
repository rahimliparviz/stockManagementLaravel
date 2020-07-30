<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    //TODO : burda product_id ni relation kimi ver
    public function AddToCart(Request $request, $id){
        $product = Product::where('id',$id)->first();

        $check = Pos::where('product_id',$id)->first();

        if ($check) {
            Pos::where('product_id',$id)->increment('product_quantity');

            $product = Pos::where('product_id',$id)->first();
            $subtotal = $product->product_quantity * $product->product_price;
            Pos::where('product_id',$id)->update(['sub_total'=> $subtotal]);

        }else{
            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->product_name;
            $data['product_quantity'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;

            Pos::insert($data);
        }



    }


    public function cartProducts(){
        $cart = Pos::all();
        return response()->json($cart);
    }



    public function removeCart($id){
        Pos::find($id)->delete();
        return response('Done');

    }


    public function increment($id){

        $product = Pos::find($id);
        $product->increment('product_quantity');
        $product->sub_total= $product->product_quantity * $product->product_price;
        $product->update();
        return response('Done');
    }


    public function decrement($id){
        $product = Pos::find($id);
        $product->decrement('product_quantity');
        $product->sub_total= $product->product_quantity * $product->product_price;
        $product->update();
        return response('Done');
    }





}
