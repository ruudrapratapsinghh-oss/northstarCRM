<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 📄 LIST + SEARCH + PAGINATION
    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    // ➕ CREATE PAGE
    public function create()
    {
        return view('products.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        // ✅ Safe insert
        Product::create($request->only([
            'name',
            'description',
            'price',
            'quantity'
        ]));

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Added Successfully');
    }

    // ✏️ EDIT PAGE
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        // ✅ Safe update
        $product->update($request->only([
            'name',
            'description',
            'price',
            'quantity'
        ]));

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }

    // ❌ DELETE
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}