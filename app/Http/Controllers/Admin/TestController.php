<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testDesign()
    {
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
