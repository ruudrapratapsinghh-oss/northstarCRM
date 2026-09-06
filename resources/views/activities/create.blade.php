@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Create Activity</h2>

        <form method="POST" action="{{ route('activities.store') }}">
            @csrf

            <div class="mb-4">
                <label class="text-sm">Title</label>
                <input type="text" name="title"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter title">
            </div>

            <div class="mb-4">
                <label class="text-sm">Description</label>
                <textarea name="description"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter description"></textarea>
            </div>

            <div class="mb-4">
                <label class="text-sm">Date</label>
                <input type="date" name="date"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('activities.index') }}" class="text-gray-500 hover:underline">
                    ← Back
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                    Save
                </button>
            </div>

        </form>

    </div>

</div>

@endsection