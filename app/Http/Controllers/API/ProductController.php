<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\Help;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::
        join('categories', 'products.category_id', 'categories.id')
            ->join('suppliers', 'products.supplier_id', 'suppliers.id')
            ->select('categories.category_name', 'suppliers.name as supplier_name', 'products.*')
            ->orderBy('products.id', 'DESC')
            ->get();
        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'buying_date' => 'required',
            'product_quantity' => 'required|numeric',

        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;

        if ($request->photo) {
            $imgUrl = Help::saveImage($request->photo, 'product');

            $product->photo = $imgUrl;
        }

        $product->save();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255|unique:products,product_code,' . $request->get('id'),
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'buying_date' => 'required',
            'product_quantity' => 'required|numeric',

        ]);


        $product = Product::find($id);

        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;
        $image = $request->photo;

        if ($request->imageChanged && $image) {
            $imgUrl = Help::updateModelWithImage($product,$image,'product');
            $product->photo = $imgUrl;

        }

        $product->save();


        return response()->json(['status' => 'success', 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $photo = $product->image;
        if ($photo) {
            unlink(substr($photo,1));
        }
        $product->delete();

    }


    public function stockUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_quantity' => 'required|numeric|min:0',
        ]);

        $product = Product::find($id);
        $product->product_quantity = $request->product_quantity;
        $product->save();

    }


}
