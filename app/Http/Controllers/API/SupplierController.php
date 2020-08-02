<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\Help;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers',

        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->shop_name = $request->shop_name;
        $supplier->address = $request->address;

        if ($request->photo) {
            $imgUrl = Help::saveImage($request->photo, 'supplier');

            $supplier->photo = $imgUrl;
        }
        $supplier->save();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
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
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->shop_name = $request->shop_name;
        $supplier->address = $request->address;

        $image = $request->newphoto;

        if ($request->isPhotoChanged && $image) {
            $imgUrl = Help::updateModelWithImage($supplier, $image, 'supplier');

            if ($imgUrl) {
                $supplier->photo = $imgUrl;
            }

        }

        $supplier->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Todo - delete model with image adli helper metod yarat
        $supplier = Supplier::find($id);
        $photo = $supplier->photo;
        if ($photo) {
            unlink(substr($photo, 1));
        }
        Supplier::where('id', $id)->delete();
    }
}
