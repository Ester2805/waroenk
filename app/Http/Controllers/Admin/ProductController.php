<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->withSum(['orderItems as sold_total' => function ($relation) {
                $relation->whereHas('order', function ($orderQuery) {
                    $orderQuery->where('status', 'completed');
                });
            }], 'qty')
            ->withAvg(['orderItems as rating_avg' => function ($relation) {
                $relation->whereNotNull('rating')
                    ->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', 'completed');
                    });
            }], 'rating')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $shippingOptions = ShippingOption::orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'shippingOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
            'shipping_options' => 'nullable|array',
            'shipping_options.*' => 'exists:shipping_options,id',
        ]);

        $data = $validated;
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeProductImage($request->file('image'), $request->input('name'));
        }

        unset($data['image']);

        $shippingOptionIds = $validated['shipping_options'] ?? [];
        unset($data['shipping_options']);

        $product = Product::create($data);

        $product->shippingOptions()->sync($shippingOptionIds);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load('shippingOptions');
        $categories = Category::orderBy('name')->get();
        $shippingOptions = ShippingOption::orderBy('name')->get();
        $selectedShippingOptions = $product->shippingOptions->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'shippingOptions', 'selectedShippingOptions'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
            'shipping_options' => 'nullable|array',
            'shipping_options.*' => 'exists:shipping_options,id',
        ]);

        $data = $validated;
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $this->deleteProductImage($product->image_path);

            $data['image_path'] = $this->storeProductImage($request->file('image'), $request->input('name'));
        }

        unset($data['image']);

        $shippingOptionIds = $validated['shipping_options'] ?? [];
        unset($data['shipping_options']);

        $product->update($data);
        $product->shippingOptions()->sync($shippingOptionIds);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteProductImage($product->image_path);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Simpan gambar produk ke public/images dan kembalikan path relatif.
     */
    private function storeProductImage($image, string $productName): string
    {
        $directory = public_path('images/product');

        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $extension = $image->getClientOriginalExtension();
        $filename = Str::uuid()->toString() . '-' . Str::slug(Str::limit($productName, 40, '')) . '.' . $extension;

        $image->move($directory, $filename);

        return 'images/product/' . $filename;
    }

    /**
     * Hapus gambar produk dari public/images jika ada.
     */
    private function deleteProductImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
