<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingOption;
use Illuminate\Http\Request;

class ShippingOptionController extends Controller
{
    public function index()
    {
        $options = ShippingOption::orderBy('name')->get();

        return view('admin.shipping.index', compact('options'));
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'estimated_time' => 'nullable|string|max:255',
            'additional_cost' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['additional_cost'] = $data['additional_cost'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        ShippingOption::create($data);

        return redirect()->route('admin.shipping-options.index')->with('success', 'Opsi pengiriman berhasil ditambahkan.');
    }

    public function edit(ShippingOption $shippingOption)
    {
        return view('admin.shipping.edit', compact('shippingOption'));
    }

    public function update(Request $request, ShippingOption $shippingOption)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'estimated_time' => 'nullable|string|max:255',
            'additional_cost' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['additional_cost'] = $data['additional_cost'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        $shippingOption->update($data);

        return redirect()->route('admin.shipping-options.index')->with('success', 'Opsi pengiriman berhasil diperbarui.');
    }

    public function destroy(ShippingOption $shippingOption)
    {
        $shippingOption->delete();

        return redirect()->route('admin.shipping-options.index')->with('success', 'Opsi pengiriman berhasil dihapus.');
    }
}
