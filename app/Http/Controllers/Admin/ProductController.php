<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view("admin.product.index", compact("products"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"  => ["required", "string", "max:20"],
            "price" => ["required", "numeric"],
        ]);

        $product = Product::create([
            "name"  => $request->name,
            "price" => $request->price,
        ]);

        return response()->json([
            "success" => true,
            "data"    => $product,
            "message" => "Product created successfully",
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name"  => ["required", "string", "max:20"],
            "price" => ["required", "numeric"],
        ]);

        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $product->update([
            "name"  => $request->name,
            "price" => $request->price,
        ]);

        return response()->json([
            "success" => true,
            "data"    => $product,
            "message" => "Product updated successfully",
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $product->delete();

        return response()->json([
            "success" => true,
            "data"    => null,
            "message" => "Product deleted successfully",
        ], 200);
    }
}
