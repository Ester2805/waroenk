<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->get('category');

        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->get();

        return view('products.index', compact('products', 'categories', 'categoryId'));
    }
}
