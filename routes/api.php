<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:API')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware'=>'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');

});

Route::group([
    'middleware'=>'JWT',

],function ($router){
    Route::APIResource('/products', 'API\ProductController');
    Route::APIResource('/employees', 'API\EmployeeController');
    Route::APIResource('/suppliers', 'API\SupplierController');
    Route::APIResource('/categories', 'API\CategoryController');
    Route::Post('/stock/update/{id}', 'API\ProductController@StockUpdate');
    Route::APIResource('/expenses', 'API\ExpenseController');
    Route::APIResource('/customers', 'API\CustomerController');


//Salary
    Route::Post('/salary/pay', 'API\SalaryController@Pay');
    Route::Get('/salary', 'API\SalaryController@AllSalary');
    Route::Get('/salary/view/{id}', 'API\SalaryController@ViewSalary');
    Route::Get('/edit/salary/{id}', 'API\SalaryController@EditSalary');
    Route::Post('/salary/update/{id}', 'API\SalaryController@SalaryUpdate');


//////////////////////////////////////////////////////////////



// Vat Route
    Route::Get('/regulations/', 'API\RegulationController@regulations');


// Add to cart Route
    Route::Get('/cart/add/{id}', 'API\CartController@AddToCart');
    Route::Get('/cart/products', 'API\CartController@cartProducts');
    Route::Get('/cart/remove/{id}', 'API\CartController@removeCart');
    Route::Get('/cart/product/increment/{id}', 'API\CartController@increment');
    Route::Get('/cart/product/decrement/{id}', 'API\CartController@decrement');


// Order Route
    Route::Get('/orders', 'API\OrderController@todaysOrders');
    Route::Get('/order/{id}', 'API\OrderController@order');
    Route::Get('/order/order-details/{id}', 'API\OrderController@OrderPruducts');
    Route::Post('/search/order', 'API\PosController@ordersByDate');

// Admin Dashboard Route
    Route::Get('/today/sell', 'API\PosController@TodaySell');
    Route::Get('/today/income', 'API\PosController@TodayIncome');
    Route::Get('/today/due', 'API\PosController@TodayDue');
    Route::Get('/today/expense', 'API\PosController@TodayExpense');
    Route::Get('/today/stock-out', 'API\PosController@Stockout');
    Route::Get('/category/products/{id}', 'API\PosController@GetProduct');
    Route::Post('/order', 'API\PosController@order');

});




