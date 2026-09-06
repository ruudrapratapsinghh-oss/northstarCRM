@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Products</h2>

        <a href="{{ route('products.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
            + Add Product
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-4">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="w-full md:w-1/3 border p-2 rounded shadow-sm"
        >
    </form>

    <!-- TABLE -->
    <div class="overflow-x-auto bg-white shadow rounded">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3 font-semibold">{{ $product->name }}</td>

                    <td class="p-3 text-green-600 font-bold">
                        ₹{{ $product->price }}
                    </td>

                    <td class="p-3">{{ $product->quantity }}</td>

                    <!-- STOCK STATUS -->
                    <td class="p-3">
                        @if($product->quantity > 10)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                In Stock
                            </span>
                        @elseif($product->quantity > 0)
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                Low Stock
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                Out of Stock
                            </span>
                        @endif
                    </td>

                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('products.edit', $product->id) }}" 
                           class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" 
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button 
                                onclick="return confirm('Delete this product?')"
                                class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-500">
                        No products found 😢
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>

@endsection