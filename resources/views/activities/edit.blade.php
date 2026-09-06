@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Edit Activity</h2>

        <form method="POST" action="{{ route('activities.update', $activity->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="text-sm">Title</label>
                <input type="text" name="title"
                    value="{{ $activity->title }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="text-sm">Description</label>
                <textarea name="description"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ $activity->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="text-sm">Date</label>
                <input type="date" name="date"
                    value="{{ $activity->date }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('activities.index') }}" class="text-gray-500 hover:underline">
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