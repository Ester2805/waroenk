<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    // Fitur pencarian produk berdasarkan nama
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        // Jika tidak ada keyword, tampilkan semua produk aktif
        if (!$keyword) {
            $products = Product::where('is_active', true)->get();
        } else {
            $products = Product::where('is_active', true)
                ->where('name', 'like', "%{$keyword}%")
                ->get();
        }

        return view('products.index', compact('products', 'keyword'));
    }
}
