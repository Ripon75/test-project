<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Events\NewOrderPlaced;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function testDesign()
    {
        event(new NewOrderPlaced("sfjlsdfjsldflsdfldsf"));

        return view("adminend.pages.test.test-design");
    }

    function postCreate()
    {
        return view("adminend.pages.test.show-toaster-message");
    }

    function postStore(Request $request)
    {
        return back()->with("success", "Test flash message");
    }
}
