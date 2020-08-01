<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function dateReports(Request $request)
    {
        //TODO: create Helper class for this functionality
        //Todo expense table inda expence date sil
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $dayBeforeDate = $date->copy()->subDay();



        $dayBeforeOrders = Order::
            whereDate('created_at',$dayBeforeDate);

        $orders =Order::whereDate('created_at',$date)
            ->union($dayBeforeOrders)
            ->orderBy('created_at')
            ->get()
        ->groupBy('created_at','id');


        $dayBeforeExpenses = Expense::whereDate('created_at',$dayBeforeDate);
        $expenses = Expense::whereDate('created_at',$date)
            ->union($dayBeforeExpenses)
            ->orderBy('created_at')
            ->get()
            ->groupBy('created_at','id');
        ;


        $expenseReportForDate= [
            'selectedDayExpense'=>0,
            'dayBeforeExpense'=>0
        ];
        if(count($expenses) == 2){
            $dayBefore = $expenses->first();
            $selectedDay = $expenses->last();
            $expenseReportForDate = [
                'dayBeforeExpense'=>$dayBefore->sum('amount'),
                'selectedDayExpense'=>$selectedDay->sum('amount'),
            ];
        }elseif (count($expenses) == 1){
            $isSelectedDay = $expenses->first()->first()->created_at == $date->format('Y-m-d') ? true : false;

//            dd($expenses);
            if ($isSelectedDay){
                $expenseReportForDate = [
                    'selectedDayExpense'=>$expenses->first()->sum('amount'),
                    'dayBeforeExpense'=>0
                ];
            }else{
                $expenseReportForDate = [
                    'selectedDayExpense'=>0,
                    'dayBeforeExpense'=>$expenses->first()->sum('amount'),
                ];
            }
        }



        $ordersReportForDate= [
            'dayBeforeSell'=> 0,
            'dayBeforeIncome'=>0,
            'dayBeforeDue'=>0,
            'selectedDaySell'=>0,
            'selectedDayIncome'=>0,
            'selectedDayDue'=>0,];
        if(count($orders) == 2){
             $dayBefore = $orders->first();
             $selectedDay = $orders->last();
             $ordersReportForDate = [
                'dayBeforeSell'=> $dayBefore->sum('price_with_vat'),
                'dayBeforeIncome'=>$dayBefore->sum('pay'),
                'dayBeforeDue'=>$dayBefore->sum('due'),
                'selectedDaySell'=> $selectedDay->sum('price_with_vat'),
                'selectedDayIncome'=>$selectedDay->sum('pay'),
                'selectedDayDue'=>$selectedDay->sum('due'),
            ];
        }elseif (count($orders) == 1){
            $isSelectedDay = $orders->first()->first()->created_at == $date->format('Y-m-d') ? true : false;

            if ($isSelectedDay){
                $ordersReportForDate = [
                    'dayBeforeSell'=> 0,
                    'dayBeforeIncome'=>0,
                    'dayBeforeDue'=>0,
                    'selectedDaySell'=> $orders->first()->sum('price_with_vat'),
                    'selectedDayIncome'=>$orders->first()->sum('pay'),
                    'selectedDayDue'=>$orders->first()->sum('due'),
                ];
            }else{
                $ordersReportForDate = [
                    'dayBeforeSell'=> $orders->first()->sum('price_with_vat'),
                    'dayBeforeIncome'=>$orders->first()->sum('pay'),
                    'dayBeforeDue'=>$orders->first()->sum('due'),
                    'selectedDaySell'=>0,
                    'selectedDayIncome'=>0,
                    'selectedDayDue'=>0,
                ];
            }
        }


        $report = [
            'orders'=>$ordersReportForDate,
            'expenses'=>$expenseReportForDate
        ];

        return response()->json($report);
    }

    public function stockOut(){

        $product = Product::where('product_quantity','<','1')->get();
        return response()->json($product);

    }
}
