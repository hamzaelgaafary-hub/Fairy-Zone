<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', function () {
    return redirect('/app/login');
})->name('login'); 
Route::get('register', function () {
    return redirect('/app/register');
})->name('register');

Route::get('logout', function () {
    return redirect('/app/logout');
})->name('logout');


//Route::get('/app',  [OrderController::class, 'checkout'])->name('user.dashboard');

//Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

//Cart Routes// 
Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',      [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update',  [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

//Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout',  [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
});
