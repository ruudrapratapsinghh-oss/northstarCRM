@extends('layouts.app')

@section('content')

<div class="p-6 max-w-xl mx-auto bg-white shadow-lg rounded-lg">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold mb-4">✏️ Edit Product</h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="mb-3">
            <label class="block font-semibold mb-1">Product Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $product->name) }}"
                   class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label class="block font-semibold mb-1">Description</label>
            <textarea 
                name="description" 
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            >{{ old('description', $product->description) }}</textarea>

            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- PRICE -->
        <div class="mb-3">
            <label class="block font-semibold mb-1">Price (₹)</label>
            <input type="number" 
                   name="price" 
                   value="{{ old('price', $product->price) }}"
                   class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

            @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- QUANTITY -->
        <div class="mb-3">
            <label class="block font-semibold mb-1">Quantity</label>
            <input type="number" 
                   name="quantity" 
                   value="{{ old('quantity', $product->quantity) }}"
                   class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-yellow-400">

            @error('quantity')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex justify-between items-center mt-4">

            <button 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Update Product
            </button>

            <a href="{{ route('products.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection