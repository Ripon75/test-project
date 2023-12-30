<?php

namespace App\Http\Controllers;

use App\jobs\SendMailJob;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    function sendMail()
    {
        return view('send-mail');
    }

    function store(Request $request)
    {
        dispatch(new SendMailJob((object)$request->all()));

        return back();
    }
}
