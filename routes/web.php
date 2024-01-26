<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GoogleMapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-email',  [SendMailController::class, 'sendMail']);
Route::post('send-email', [SendMailController::class, 'store'])->name('store.mail');


// Admin route
Route::prefix("admin")->group(function() {
    Route::get("products",            [ProductController::class, "index"]);
    Route::post("products",           [ProductController::class, "store"]);
    Route::get("products/{id}",       [ProductController::class, "show"]);
    Route::put("products/{id}",       [ProductController::class, "update"]);
    Route::delete("products/{id}",    [ProductController::class, "delete"]);
    Route::get("products/pagination", [ProductController::class, "paginationData"])->name('paginate.data');

    Route::get("google-map", [GoogleMapController::class, "index"]);

    Route::get("test-design", [TestController::class, "testDesign"]);
});
