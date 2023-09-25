<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Razorpay\Api\Api;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('product',[ProductController::class,'index'])->name('product');
Route::post('razorpay-payment',[ProductController::class,'store'])->name('razorpay.payment.store');
Route::get('thanks',[ProductController::class,'orderconfirm'])->name('orderconfirm.page');
Route::post('subcription',[ProductController::class,'subscription'])->name('subscription.page');
Route::get('subcription-confirm',[ProductController::class,'subscriptionconfirm'])->name('suscription.confirm');


Route::get('stripe',[ProductController::class,'stripe'])->name('stripe.page');
