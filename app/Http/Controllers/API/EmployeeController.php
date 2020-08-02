<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\Help;
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
     * @param \Illuminate\Http\Request $request
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

            $imgUrl = Help::saveImage($request->photo, 'employee');


            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->address = $request->address;
            $employee->joining_date = $request->joining_date;
            $employee->photo = $imgUrl;
            $employee->save();
        } else {
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->address = $request->address;
            $employee->joining_date = $request->joining_date;

            $employee->save();

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
        $employee = Employee::find($id);
        return response()->json($employee);
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
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $employee->joining_date = $request->joining_date;
        $image = $request->photo;


        if ($request->isNewPhotoAdded && $image) {

            $imgUrl = Help::updateModelWithImage($employee, $image, 'employee');

            if ($imgUrl) {
                $employee->photo = $imgUrl;
            }
        }

        $employee->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $photo = $employee->photo;
        if ($photo) {
            unlink(substr($photo,1));
        }
        $employee->delete();

    }
}
