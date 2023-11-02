<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    function sendMail()
    {
        return view('send-mail');
    }

    function store(Request $request)
    {
        Mail::to($request->email)->send(new SendMail($request));

        return back();
    }
}
