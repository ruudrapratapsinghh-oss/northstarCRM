@extends('layouts.app')

@section('content')

<div class="p-6 max-w-lg mx-auto bg-white shadow rounded">

    <h2 class="text-xl font-bold mb-4">Add Product</h2>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                   class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" 
                      class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" 
                   class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" 
                   class="w-full border p-2 rounded" required>
        </div>

        <div class="flex gap-2">
            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Save
            </button>

            <a href="{{ route('products.index') }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection