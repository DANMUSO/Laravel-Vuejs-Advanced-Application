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
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::put('/orders/{order_id}','App\Http\Controllers\OrdersController@UpdateOrderStatus');



Route::middleware('auth:api')->post('/orders/{order_id}/pay','App\Http\Controllers\Administrator\OrdersController@pay');

Route::middleware('auth:api')->get('/v1/failedorder/{order_id}','App\Http\Controllers\Admin\API\OrdersController@failedorder');
Route::middleware('auth:api')->get('/v1/confirmedorder/{order_id}', 'App\Http\Controllers\Admin\API\OrdersController@confirmedorder');
Route::middleware('auth:api')->get('/v1/transitorder/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@transitorder');
Route::middleware('auth:api')->get('/v1/completedorder/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@completedorder');
Route::middleware('auth:api')->get('/v1/cancelledorder/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@cancelledorder');
Route::middleware('auth:api')->get('/v1/transit/{ids}' , 'App\Http\Controllers\Admin\API\OrdersController@transit');
Route::middleware('auth:api')->get('/v1/reprocesspayment/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@reprocesspayment');
Route::middleware('auth:api')->get('/v1/cancelfailedorder/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@cancelfailedorder');
Route::middleware('auth:api')->get('/v1/completeorder/{order_id}' , 'App\Http\Controllers\Admin\API\OrdersController@completeorder');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('v1/getproducts', 'App\Http\Controllers\Admin\API\PurchaseordersController@getProducts');
Route::apiResources([
    '/v1/vendors' => 'App\Http\Controllers\Admin\API\VendorsController',
    '/v1/products' => 'App\Http\Controllers\Admin\API\ProductsController',
    '/v1/riders' => 'App\Http\Controllers\Admin\API\RidersController',
    '/v1/ridersmap' => 'App\Http\Controllers\Admin\API\RiderlocationController',
    '/v1/assignedorders' => 'App\Http\Controllers\Admin\API\AssignedordersController',
    '/v1/trips' => 'App\Http\Controllers\Admin\API\TripsController',
    '/v1/clients' => 'App\Http\Controllers\Admin\API\ClientsController',
    '/v1/payments' => 'App\Http\Controllers\Admin\API\PaymentsController',
    '/v1/purchaseorders' => 'App\Http\Controllers\Admin\API\PurchaseordersController',
    '/v1/getvendors' => 'App\Http\Controllers\Admin\API\PurchaseordersController@getVendors',
    '/v1/orders' => 'App\Http\Controllers\Admin\API\OrdersController',
    '/v1/stocks' => 'App\Http\Controllers\Admin\API\StocksController',
    'dashboard' => 'App\Http\Controllers\Admin\API\DashboardController',
    ]);