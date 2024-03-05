<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleMapController extends Controller
{
    public function index()
    {
        return view("adminend.pages.googleMap.index");
    }
}
