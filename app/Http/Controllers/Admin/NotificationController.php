<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Events\SendNotification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view("adminend.pages.notification.index");
    }

    public function sendNotification()
    {
        return view("adminend.pages.notification.send-notification");
    }

    public function triggerEvent(Request $request)
    {
        SendNotification::dispatch($request->message);

        return back();
    }
}
