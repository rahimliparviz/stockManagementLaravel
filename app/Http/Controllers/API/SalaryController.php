<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function pay(Request $request)
    {

        $validateData = $request->validate([
            'salary_month' => 'required',
            'salary' => 'required|numeric'
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id', $request->id)
            ->where('salary_month', $month)->first();
        if ($check) {
            return response()->json('Salary is already paid');
        } else {
            $data = array();
            $data['employee_id'] = $request->id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            Salary::insert($data);
        }

    }


    public function allSalary()
    {
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }


    public function viewSalary($month)
    {
        $view = Salary::
        join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.salary_month', $month)
            ->get();
        return response()->json($view);

    }


    public function editSalary($id)
    {

        $view = Salary::
        join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();
        return response()->json($view);

    }


    public function salaryUpdate(Request $request, $id)
    {

        $salary = Salary::find($id);
        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->salary_month = $request->salary_month;

        $salary->save();
    }


}
