<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GoogleMapController;
use App\Http\Controllers\FacebookMessengerController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('chat',  [ChatController::class, 'index']);
Route::post('chat/send', [ChatController::class, 'send']);

Route::match(['GET', 'POST'], '/facebook/webhook', [FacebookMessengerController::class, 'handle']);


Route::get('send-email',  [SendMailController::class, 'sendMail']);
Route::post('send-email', [SendMailController::class, 'store'])->name('store.mail');

// Frontend route
Route::get("test-design", [TestController::class, "testDesign"]);


// Admin route
Route::prefix("admin")->group(function() {
    Route::get("products",             [ProductController::class, "index"]);
    Route::post("products",            [ProductController::class, "store"]);
    Route::get("products/pagination",  [ProductController::class, "paginationData"])->name('paginate.data');
    Route::get("get-selected-product", [ProductController::class, "getSelectedProduct"]);
    Route::get("products/{id}",        [ProductController::class, "show"]);
    Route::put("products/{id}",        [ProductController::class, "update"]);
    Route::delete("products/{id}",     [ProductController::class, "delete"]);

    // Autocomplete products
    Route::get("autocomplete-products", [ProductController::class, "autocompleteProducts"]);

    Route::get("google-map", [GoogleMapController::class, "index"]);

    Route::get("test-design", [TestController::class, "testDesign"]);

    Route::get("posts", [TestController::class, "postCreate"])->name("post.create");
    Route::post("posts", [TestController::class, "postStore"])->name("post.store");
});
