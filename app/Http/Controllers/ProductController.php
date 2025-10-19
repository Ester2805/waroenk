<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ShippingOption;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $categoryId = $request->get('category');
        $keyword = $request->get('q');
        $shippingOptionId = $request->get('shipping');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $sort = $request->get('sort', 'newest');
        $minRating = $request->get('min_rating');

        $query = Product::with('category')->where('is_active', true);

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($shippingOptionId) {
            $query->whereHas('shippingOptions', function ($relation) use ($shippingOptionId) {
                $relation->where('shipping_option_id', $shippingOptionId);
            });
        }

        if ($minPrice !== null && is_numeric($minPrice)) {
            $query->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $query->where('price', '<=', (float) $maxPrice);
        }

        if ($minRating !== null && is_numeric($minRating)) {
            $query->whereHas('orderItems', function ($relation) use ($minRating) {
                $relation->whereNotNull('rating')
                    ->where('rating', '>=', (int) $minRating)
                    ->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', 'completed');
                    });
            });
        }

        $query->withSum(['orderItems as sold_total' => function ($relation) {
            $relation->whereHas('order', function ($orderQuery) {
                $orderQuery->where('status', 'completed');
            });
        }], 'qty');

        $query->withAvg(['orderItems as rating_avg' => function ($relation) {
            $relation->whereNotNull('rating')
                ->whereHas('order', function ($orderQuery) {
                    $orderQuery->where('status', 'completed');
                });
        }], 'rating');

        $products = match ($sort) {
            'popular' => $query->orderByDesc('sold_total')->orderByDesc('created_at')->get(),
            'price_low' => $query->orderBy('price')->get(),
            'price_high' => $query->orderByDesc('price')->get(),
            'rating' => $query->orderByDesc('rating_avg')->orderByDesc('sold_total')->get(),
            default => $query->orderByDesc('created_at')->get(),
        };

        if ($request->expectsJson()) {
            $html = view('products.partials.grid', ['products' => $products])->render();

            return response()->json([
                'html' => $html,
                'count' => $products->count(),
            ]);
        }

        $shippingOptions = ShippingOption::where('is_active', true)->orderBy('name')->get();

        $filters = [
            'categoryId' => $categoryId,
            'keyword' => $keyword,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'searchAction' => route('products.index'),
            'shippingOptionId' => $shippingOptionId,
            'sort' => $sort,
            'minRating' => $minRating,
        ];

        return view('products.index', compact('products', 'categories', 'filters', 'shippingOptions'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'shippingOptions'])
            ->loadSum(['orderItems as sold_total' => function ($relation) {
                $relation->whereHas('order', fn($query) => $query->where('status', 'completed'));
            }], 'qty')
            ->loadAvg(['orderItems as rating_avg' => function ($relation) {
                $relation->whereNotNull('rating')
                    ->whereHas('order', fn($query) => $query->where('status', 'completed'));
            }], 'rating');

        $reviews = $product->orderItems()
            ->with('order:id,customer_name')
            ->where(function ($query) {
                $query->whereNotNull('review')
                    ->orWhereNotNull('rating');
            })
            ->whereHas('order', fn($query) => $query->where('status', 'completed'))
            ->orderByDesc('rated_at')
            ->orderByDesc('updated_at')
            ->get();

        $relatedProducts = Product::with('category')
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn($query) => $query->where('category_id', $product->category_id))
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts', 'reviews'));
    }
}
