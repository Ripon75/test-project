<?php

use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('send-email', [SendMailController::class, 'sendMail']);
Route::post('send-email', [SendMailController::class, 'store'])->name('store.mail');
