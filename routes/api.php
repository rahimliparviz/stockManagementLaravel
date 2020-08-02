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
//    Todo : token meselesini duzenle

//    'middleware'=>'JWT',

],function ($router){
    Route::APIResource('/products', 'API\ProductController');
    Route::APIResource('/employees', 'API\EmployeeController');
    Route::APIResource('/suppliers', 'API\SupplierController');
    Route::APIResource('/categories', 'API\CategoryController');
    Route::Post('/stock/update/{id}', 'API\ProductController@stockUpdate');
    Route::APIResource('/expenses', 'API\ExpenseController');
    Route::APIResource('/customers', 'API\CustomerController');


//Salary
    Route::Post('/salary/pay', 'API\SalaryController@pay');
    Route::Get('/salary', 'API\SalaryController@allSalary');
    Route::Get('/salary/view/{id}', 'API\SalaryController@viewSalary');
    Route::Get('/edit/salary/{id}', 'API\SalaryController@editSalary');
    Route::Post('/salary/update/{id}', 'API\SalaryController@salaryUpdate');


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
    Route::Get('/orders', 'API\OrderController@orders');
    Route::Get('/order/{id}', 'API\OrderController@order');
    Route::Get('/order/order-details/{id}', 'API\OrderController@OrderPruducts');
    Route::Post('/order', 'API\OrderController@addOrder');


// Reports Route
    Route::Get('reports/date/reports', 'API\ReportsController@dateReports');
    Route::Get('reports/today/stock-out', 'API\ReportsController@stockOut');

});




