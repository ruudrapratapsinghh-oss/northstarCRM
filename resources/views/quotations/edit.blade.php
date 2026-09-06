@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Edit Quotation</h2>

        <form action="{{ route('quotations.update', $quotation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="text-sm">Client Name</label>
                    <input type="text" name="client_name"
                        value="{{ $quotation->client_name }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Product</label>
                    <input type="text" name="product"
                        value="{{ $quotation->product }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Amount</label>
                    <input type="number" name="amount"
                        value="{{ $quotation->amount }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Valid Till</label>
                    <input type="date" name="valid_till"
                        value="{{ $quotation->valid_till }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

            </div>

            <div class="mt-4">
                <label class="text-sm">Notes</label>
                <textarea name="notes"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ $quotation->notes }}</textarea>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('quotations.index') }}" class="text-gray-500 hover:underline">
                    ← Back
                </a>

                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>

@endsection