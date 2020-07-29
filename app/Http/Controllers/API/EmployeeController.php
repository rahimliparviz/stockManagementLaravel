<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
// use Intervention\Image\Image as Image;
use Image;

class EmployeeController extends Controller
{
    public function index()
    {
       $employee = Employee::all();
       return response()->json($employee);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //TODO : image upload ucun helper function yarat
    public function store(Request $request)
    {
        $validateData = $request->validate([
         'name' => 'required|unique:employees|max:255',
         'email' => 'required',
         'phone' => 'required|unique:employees',
         'salary' => 'required|numeric',

        ]);

      if ($request->photo) {
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);

         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->salary = $request->salary;
         $employee->address = $request->address;
         $employee->nid = $request->nid;
         $employee->joining_date = $request->joining_date;
         $employee->photo = $image_url;
         $employee->save();
     }else{
        $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->salary = $request->salary;
         $employee->address = $request->address;
         $employee->nid = $request->nid;
         $employee->joining_date = $request->joining_date;

         $employee->save();

     }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employee = Employee::where('id',$id)->first();
       return response()->json($employee);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['salary'] = $request->salary;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;
        $image = $request->newphoto;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);

         if ($success) {
            $data['photo'] = $image_url;
            $img = Employee::where('id',$id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user  = Employee::where('id',$id)->update($data);
         }

        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = Employee::where('id',$id)->update($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employee = Employee::where('id',$id)->first();
       $photo = $employee->photo;
       if ($photo) {
         unlink($photo);
         Employee::where('id',$id)->delete();
       }else{
         Employee::where('id',$id)->delete();
       }
    }
}
