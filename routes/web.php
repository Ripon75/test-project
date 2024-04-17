<?php

use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\FullCalenderController;
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

    Route::get("posts",  [TestController::class, "postCreate"])->name("post.create");
    Route::post("posts", [TestController::class, "postStore"])->name("post.store");

    // Dynamic form add and removed
    Route::get("add-items", [TestController::class, "addItem"])->name("add.items");

    // File upload
    Route::get("file/uploads",        [FileUploadController::class, 'index'])->name('file.index');
    Route::get("file/uploads/create", [FileUploadController::class, 'create'])->name('file.create');
    Route::post("file/uploads",       [FileUploadController::class, 'store'])->name('file.store');
    Route::get("file/download/{id}",  [FileUploadController::class, 'download'])->name('file.download');
    Route::get("file/show/{id}",      [FileUploadController::class, 'show'])->name('file.show');

    // Full calender
    Route::get("full-calender",         [FullCalenderController::class, 'index'])->name('full-calender');
    Route::post('full-calender/action', [FullCalenderController::class, 'action']);
});
