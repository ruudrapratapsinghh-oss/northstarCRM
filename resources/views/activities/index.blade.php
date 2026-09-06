@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Activities</h2>

        <a href="{{ route('activities.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Add Activity
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($activities as $activity)
                <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                    <td class="p-4 font-medium">
                        {{ $activity->title }}
                    </td>

                    <td class="p-4 text-gray-600 dark:text-gray-300">
                        {{ \Illuminate\Support\Str::limit($activity->description, 50) }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                    </td>

                    <td class="p-4 flex gap-2">

                        <a href="{{ route('activities.edit', $activity->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">
                        No activities found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection