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

        return view("adminend.pages.product.index", compact("products"));
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

    public function show()
    {
        return "Show";
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

    public function paginationData(Request $request)
    {
        $searchKey = $request->input('search_key', null);

        $products = Product::when($searchKey, fn($query) => $query->where("name", "like", "%$searchKey%"))
            ->latest()->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                "data"   => $products,
                "status" => "success"
            ]);
        }

        return view("adminend.pages.product.pagination-products", compact("products"))->render();
    }

    public function autocompleteProducts()
    {
        return Product::pluck('name')->toArray();
    }
}
