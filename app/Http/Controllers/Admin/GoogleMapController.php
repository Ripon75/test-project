<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleMapController extends Controller
{
    public function index()
    {
        $products = [];

        return view("admin.googleMap.index", compact("products"));
    }
}
