@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Contacts</h2>

        <a href="{{ route('contacts.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Add Contact
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-4">
        <input type="text" name="search"
            value="{{ request('search') }}"
            placeholder="Search contacts..."
            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
    </form>

    <!-- TABLE CARD -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Phone</th>
                    <th class="p-4 text-left">Company</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($contacts as $contact)
                <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                    <!-- NAME + AVATAR -->
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 text-white flex items-center justify-center rounded-full">
                            {{ strtoupper(substr($contact->name,0,1)) }}
                        </div>
                        {{ $contact->name }}
                    </td>

                    <td class="p-4 text-gray-600">{{ $contact->email }}</td>

                    <td class="p-4">{{ $contact->phone }}</td>

                    <td class="p-4">{{ $contact->company }}</td>

                    <td class="p-4 flex gap-2">

                        <a href="{{ route('contacts.edit',$contact->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
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
                    <td colspan="5" class="text-center p-6 text-gray-500">
                        No contacts found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- PAGINATION (optional if added) -->
    <div class="mt-4">
        {{ $contacts->links() ?? '' }}
    </div>

</div>

@endsection