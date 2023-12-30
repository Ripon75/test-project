<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('send-email', [SendMailController::class, 'sendMail']);
Route::post('send-email', [SendMailController::class, 'store'])->name('store.mail');


// Admin route
Route::get("admin/products",         [ProductController::class, "index"]);
Route::post("admin/products",        [ProductController::class, "index"]);
Route::put("admin/products/{id}",    [ProductController::class, "index"]);
Route::delete("admin/products/{id}", [ProductController::class, "index"]);

