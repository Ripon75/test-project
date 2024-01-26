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
}
