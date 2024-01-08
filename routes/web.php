<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GoogleMapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-email',  [SendMailController::class, 'sendMail']);
Route::post('send-email', [SendMailController::class, 'store'])->name('store.mail');


// Admin route
Route::get("admin/products",         [ProductController::class, "index"]);
Route::post("admin/products",        [ProductController::class, "store"]);
Route::get("admin/products/{id}",    [ProductController::class, "show"]);
Route::put("admin/products/{id}",    [ProductController::class, "update"]);
Route::delete("admin/products/{id}", [ProductController::class, "delete"]);
Route::get("admin/pagination/products", [ProductController::class, "paginationData"]);

Route::get("admin/google-map", [GoogleMapController::class, "index"]);

