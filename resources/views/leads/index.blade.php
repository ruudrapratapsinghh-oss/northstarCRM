@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6 space-y-6">

    <!-- 🔥 Page Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Leads Dashboard
        </h2>

        <div class="flex gap-2">
            @auth 
            @if(auth()->user()->isAdmin())
            <a href="{{ route('leads.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                + Add Lead
            </a>
            @endif
            @endauth

            <a href="{{ route('leads.export') }}" 
               class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow">
                Export CSV
            </a>
        </div>
    </div>

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- 🔍 Filter Box -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow flex flex-wrap gap-3 items-center">

        <form method="GET" action="{{ route('leads.index') }}" class="flex flex-wrap gap-3 w-full">

            <input type="text" name="search"
                placeholder="Search name or email..."
                value="{{ request('search') }}"
                class="border rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-blue-400">

            <select name="status" class="border rounded-lg px-3 py-2">
                <option value="">All Status</option>
                <option value="new" {{ request('status')=='new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ request('status')=='contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="converted" {{ request('status')=='converted' ? 'selected' : '' }}>Converted</option>
            </select>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Apply
            </button>

        </form>
    </div>

    <!-- 🔥 Follow Ups -->
    <div>
        <h3 class="text-lg font-semibold text-red-500 mb-2">Today's Follow-Ups</h3>

        @if(isset($todayFollowUps) && $todayFollowUps->count())
            <div class="grid md:grid-cols-3 gap-3">
                @foreach($todayFollowUps as $lead)
                    <div class="bg-yellow-100 p-3 rounded-lg shadow">
                        <p class="font-semibold">{{ $lead->name }}</p>
                        <p class="text-sm text-gray-600">{{ $lead->phone }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No follow-ups today</p>
        @endif
    </div>

    <!-- 🔥 Table Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <table class="w-full text-sm">

            <!-- Head -->
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Phone</th>
                    <th class="p-4 text-left">Company</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Follow Up</th>
                    <th class="p-4 text-left">Notes</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y">

                @forelse($leads as $lead)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                    <td class="p-4 font-medium">{{ $lead->name }}</td>
                    <td class="p-4">{{ $lead->email }}</td>
                    <td class="p-4">{{ $lead->phone }}</td>
                    <td class="p-4">{{ $lead->company }}</td>

                    <!-- Status -->
                    <td class="p-4">
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($lead->status == 'new') bg-blue-100 text-blue-700
                            @elseif($lead->status == 'contacted') bg-yellow-100 text-yellow-700
                            @else bg-green-100 text-green-700
                            @endif">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </td>

                    <td class="p-4">{{ $lead->follow_up_date }}</td>
                    <td class="p-4 truncate max-w-xs">{{ $lead->notes }}</td>

                    <!-- Actions -->
                    <td class="p-4 flex gap-2">

                        @auth
                        @if(auth()->user()->isAdmin())

                        <a href="{{ route('leads.edit', $lead->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST"
                              onsubmit="return confirm('Delete this lead?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                Delete
                            </button>
                        </form>

                        @endif
                        @endauth

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center p-6 text-gray-500">
                        No leads found 🚀
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <!-- Pagination -->
    <div>
        {{ $leads->links() }}
    </div>

</div>
@endsection