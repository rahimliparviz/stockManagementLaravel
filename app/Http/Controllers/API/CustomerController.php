<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\Help;
use Illuminate\Http\Request;
use DB;
use App\Models\Customer;
use Image;
use function GuzzleHttp\Psr7\str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'DESC')->get();
        return response()->json($customer);
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
            'name' => 'required|unique:customers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:customers',

        ]);

        if ($request->photo) {
            $imgUrl = Help::saveImage($request->photo, 'customer');

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->photo = $imgUrl;
            $customer->save();
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;

            $customer->save();

        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        return response()->json($customer);
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
        //Todo: add validation to each action of all controllers
        $customer = Customer::find($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $image = $request->photo;

        if ($request->newPhotoAdded && $image) {
            $imgUrl = Help::updateModelWithImage($customer, $image, 'customer');

            if ($imgUrl) {
                $customer->photo = $imgUrl;

            }

        }

        $customer->save();

        return response()->json(['status' => 'success', 'message' => 'Customer updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $photo = $customer->photo;
        if ($photo) {
            unlink(substr($photo, 1));
        }
        $customer->delete();
    }


}
