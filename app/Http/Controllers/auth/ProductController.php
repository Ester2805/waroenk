<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%")
                           ->get();

        return view('search', compact('products', 'query'));
    }
}
