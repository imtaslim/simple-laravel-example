<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PayMethodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;

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

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/single_product', [UserController::class, 'sin_pro'])->name('sinpro');


//User Dashboard Route
Route::middleware(['auth:sanctum', 'verified'])->get('/user/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/user/single_order', [UserController::class, 'sin_or'])->name('sin_or');
Route::middleware(['auth:sanctum', 'verified'])->post('/user/single_order', [UserController::class, 'orderCancel'])->name('orderCancel');

//cart route
Route::middleware(['auth:sanctum', 'verified'])->post('/cart', [CartController::class, 'cartprocess'])->name('cartpro');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart', [CartController::class, 'cart'])->name('cart');
Route::middleware(['auth:sanctum', 'verified'])->delete('cart/{id}', [CartController::class, 'cancelcart'])->name('cancelcart');
Route::middleware(['auth:sanctum', 'verified'])->get('clearcart', [CartController::class, 'clearcart'])->name('clearcart');
Route::middleware(['auth:sanctum', 'verified'])->get('/shipping_address', [CartController::class, 'address'])->name('address');
Route::middleware(['auth:sanctum', 'verified'])->put('/shipping_address/{id}', [CartController::class, 'updateaddress'])->name('updateaddress');

//checkout Routes
Route::middleware(['auth:sanctum', 'verified'])->post('/checkout', [checkoutController::class, 'checkoutprocess'])->name('checkoutprocess');



//Admin Dashboard Route
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//category routes
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/add_category', [AdminController::class, 'addCat'])->name('addCat');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->post('/add_category', [AdminController::class, 'addCatProcess'])->name('addCatProcess');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->delete('delete_category/{id}', [AdminController::class, 'delCat'])->name('delCat');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('edit_categoty/{id}', [AdminController::class, 'editCategory'])->name('editCat');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->put('edit_category/{id}', [AdminController::class, 'updateCat'])->name('upcat');
//Product Routes
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/add_product', [ProductController::class, 'addpro'])->name('addpro');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->post('/add_product', [ProductController::class, 'addproProcess'])->name('addproProcess');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->delete('delete_product/{id}', [ProductController::class, 'delpro'])->name('delpro');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('edit_product/{id}', [ProductController::class, 'editproduct'])->name('editpro');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->put('edit_product/{id}', [ProductController::class, 'updatepro'])->name('uppro');
//Payment Method Routes
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/payment_method', [PayMethodController::class, 'addpay'])->name('addpay');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->post('/payment_method', [PayMethodController::class, 'addpayProcess'])->name('addpayProcess');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->delete('delete_payment_method/{id}', [PayMethodController::class, 'delpay'])->name('delpay');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('edit_payment_method/{id}', [PayMethodController::class, 'editpay'])->name('editpay');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->put('edit_payment_method/{id}', [PayMethodController::class, 'updatepay'])->name('uppay');
//Admin Order panel route
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/all_orders', [AdminOrderController::class, 'order'])->name('order');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/single_orders', [AdminOrderController::class, 'sin_or'])->name('sin_order');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->post('/admin/single_order', [AdminOrderController::class, 'orderCancel'])->name('or_Cancel');
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->get('/all_user', [AdminOrderController::class, 'users'])->name('users');