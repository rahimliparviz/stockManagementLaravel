<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
         'category_name' => 'required|unique:categories|max:255',
        ]);

         $category = new Category;
         $category->category_name = $request->category_name;

         $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $category =Category::findOrFail($id);
       return response()->json($category);
    }



    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
    ]   );
        $data = array();
        $data['category_name'] =  $request->category_name;
        Category::findOrFail($id)->update($data);
        return response()->json(['status'=>'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Category::findOrFail($id)->delete();
      return response()->json(['status'=>'success']);
    }
}

