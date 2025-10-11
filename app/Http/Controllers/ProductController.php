<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * 🛍️ Tampilkan semua produk aktif + filter kategori (jika dipilih)
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown filter
        $categories = Category::all();

        // Ambil ID kategori dari query string (jika ada)
        $categoryId = $request->get('category');

        // Query produk
        $query = Product::where('is_active', true);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Ambil hasil
        $products = $query->get();

        return view('products.index', compact('products', 'categories', 'categoryId'));
    }
}
