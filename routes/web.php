<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InverterController;
use App\Http\Controllers\BatteriesController;
use App\Http\Controllers\PanelController;
////////////PUBLIC SIDE////////////

Route::get('/', function () {
    return view('home');

});

Route::get('/about', function () {
    return view('about');
});
Route::get('/product', function () {
    return view('product');
});
Route::get('/quote', function () {
    return view('quote');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login']);

////////////USER SIDE////////////

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/profile', [UserController::class, 'showProfile']);
Route::put('/profile/{id}/upload_photo', [UserController::class, 'uploadPhotoProfile']);


Route::get('/order', [OrderController::class, 'showOrders']);
Route::get('/order/completed', [OrderController::class, 'showMyCompletedOrders']);
Route::get('/order/{id}', [OrderController::class, 'showOrder']);
Route::put('/receive_order/{id}', [OrderController::class, 'receiveOrder']);
Route::put('/cancel_order/{id}', [OrderController::class, 'cancelMyOrder']);

Route::get('/store', [OrderController::class, 'showStore']);
Route::get('/battery_store', [OrderController::class, 'showBatteries']);
Route::get('/inverter_store', [OrderController::class, 'showInverter']);
Route::get('/panel_store', [OrderController::class, 'showPanel']);
Route::post('/store', [OrderController::class, 'takeOrder']);
Route::post('/store/checkout', [OrderController::class, 'placeOrder']);

////////////ADMIN SIDE////////////

Route::get('/admin', function () {
    return view('admin.admin_dashboard');
});

Route::get('/admin/register', [UserController::class, 'showRegister']);
Route::post('/admin/register', [UserController::class, 'register']);
Route::get('/admin/register/newadmin', [UserController::class, 'showAdminRegister']);
Route::post('/admin/register/newadmin', [UserController::class, 'adminRegister']);

Route::get('/admin/orders', [OrderController::class, 'showOngoingOrders']);
Route::get('/admin/orders/completed', [OrderController::class, 'showCompletedOrders']);
Route::get('/admin/orders/{id}', [OrderController::class, 'showOrderInfo']);
Route::put('/admin/accept_order/{id}', [OrderController::class, 'acceptOrder']);
Route::put('/admin/cancel_order/{id}', [OrderController::class, 'cancelOrder']);
Route::put('/admin/update_order/{id}', [OrderController::class, 'updateOrder']);

Route::resource('/admin/inverter', InverterController::class);
Route::put('/admin/inverter/restock/{id}', [InverterController::class, 'restock']);
Route::resource('/admin/accessory', AccessoryController::class);
Route::put('/admin/accessory/restock/{id}', [AccessoryController::class, 'restock']);
Route::resource('/admin/battery', BatteriesController::class);
Route::put('/admin/battery/restock/{id}', [BatteriesController::class, 'restock']);
Route::resource('/admin/panel', PanelController::class);
Route::put('/admin/panel/restock/{id}', [PanelController::class, 'restock']);