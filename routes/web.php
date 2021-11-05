<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\activitylog\Models\Activity;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('administrator')->group( function() {
    Route::get('/login', 'App\Http\Controllers\Auth\AdministratorLoginController@showLoginForm')->name('administrator.login');
    Route::post('/', 'App\Http\Controllers\Auth\AdministratorLoginController@login')->name('administrator.login.submit');
    Route::get('/', 'App\Http\Controllers\AdministratorController@index')->name('administrator.dashboard');
    Route::get('/logout', 'App\Http\Controllers\Auth\AdministratorLoginController@logout')->name('administrator.logout');
});



Route::resource('/administrator/products', 'App\Http\Controllers\Administrator\ProductsController', ['as'=>'administrator']);
Route::resource('/administrator/purchaseorders', 'App\Http\Controllers\Administrator\PurchaseordersController', ['as'=>'administrator']);
Route::resource('/administrator/vendors', 'App\Http\Controllers\Administrator\VendorsController', ['as'=>'administrator']);
Route::resource('/administrator/riders', 'App\Http\Controllers\Administrator\RidersController', ['as'=>'administrator']);
Route::resource('/administrator/usermap', 'App\Http\Controllers\Administrator\UsermapController', ['as'=>'administrator']);
Route::resource('/administrator/ridermap', 'App\Http\Controllers\Administrator\RidermapController', ['as'=>'administrator']);
Route::resource('/administrator/users', 'App\Http\Controllers\Administrator\UsersController', ['as'=>'administrator']);
Route::resource('/administrator/orders', 'App\Http\Controllers\Administrator\OrderController', ['as'=>'administrator']);
Route::resource('/administrator/assignedorders', 'App\Http\Controllers\Administrator\AssignedOrderController', ['as'=>'administrator']);
Route::resource('/administrator/trips', 'App\Http\Controllers\Administrator\TripsController', ['as'=>'administrator']);
Route::resource('/administrator/order', 'App\Http\Controllers\Administrator\OrderController', ['as'=>'administrator']);
Route::resource('/administrator/payments', 'App\Http\Controllers\Administrator\PaymentsController', ['as'=>'administrator']);
Route::get('administrator/vendors/delete/{vendor_id}', 'App\Http\Controllers\Administrator\VendorsController@destroy');
Route::get('administrator/orders/delete/{id}', 'App\Http\Controllers\Administrator\OrderController@destroy');
Route::get('administrator/products/delete/{product_id}', 'App\Http\Controllers\Administrator\ProductsController@destroy');
Route::get('purchaseorders/delete/{porder_id}', 'App\Http\Controllers\Administrator\PurchaseordersController@destroy');
Route::get('clients/delete/{id}', 'App\Http\Controllers\Administrator\ClientsController@destroy');
Route::post('order','App\Http\Controllers\Administrator\OrderController@show')->name('order');
Route::post('completeOrder','App\Http\Controllers\Administrator\OrderController@CompleteOrder')->name('completeOrder');
Route::get('completeOrder','App\Http\Controllers\Administrator\OrderController@index')->name('completeOrder');
Route::post('assignOrder','App\Http\Controllers\Administrator\OrderController@assignOrder')->name('assignOrder');
Route::post('confirm','App\Http\Controllers\Administrator\OrderController@confirm')->name('confirm');
Route::post('transit','App\Http\Controllers\Administrator\OrderController@transit')->name('transit');
Route::post('delivered','App\Http\Controllers\Administrator\OrderController@delivered')->name('delivered');
Route::post('cancelled','App\Http\Controllers\Administrator\OrderController@cancelled')->name('cancelled');
Route::get('/vendors', 'App\Http\Controllers\VendorsController@index')->name('vendors');
Route::post('vendors', 'App\Http\Controllers\VendorsController@store')->name('vendors.store');
Route::get('/products', 'App\Http\Controllers\ProductsController@index')->name('products');
Route::get('administrator/stocks', 'App\Http\Controllers\Administrator\StockController@index')->name('stocks');
Route::get('save-token','App\Http\Controllers\Administrator\OrderController@saveToken')->name('save-token');
Route::get('notifications','App\Http\Controllers\Administrator\OrderController@FCM_Notification')->name('notifications');
Route::post('token','App\Http\Controllers\Administrator\OrderController@Token')->name('token');
Route::get('product','App\Http\Controllers\Administrator\PurchaseordersController@select')->name('product');

Route::put('vendordeactivate','App\Http\Controllers\Administrator\VendorsController@deactivate')->name('vendordeactivate');

Route::put('vendoractivate','App\Http\Controllers\Administrator\VendorsController@activate')->name('vendoractivate');

Route::post('productdeactivate','App\Http\Controllers\Administrator\ProductsController@deactivate')->name('productdeactivate');

Route::put('productactivate','App\Http\Controllers\Administrator\ProductsController@activate')->name('productactivate');


Route::post('administrator/pay/{order_id}', 'App\Http\Controllers\Administrator\OrderController@pay');
Route::any('administrator/cancel', 'App\Http\Controllers\Administrator\OrderController@cancel')->name('cancel');
Route::any('administrator/reprocess', 'App\Http\Controllers\Administrator\OrderController@reprocess')->name('reprocess');


Route::any('/administrator/order/{orderId}', function () {
    return view('administrator.order.orders');
});/* 
Route::get('/{any}', "App\Http\Controllers\AdministratorController@index")->where('any', '.*');
 */
/* Route::get('/{vue_routes?}', function () {
    return view('administrator');
})->where('vue_routes', '[\/\w\.-]*'); */