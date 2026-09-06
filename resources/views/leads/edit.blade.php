@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">
            Edit Lead
        </h2>

        <form action="{{ route('leads.update', $lead->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-sm mb-1">Name</label>
                <input type="text" name="name" value="{{ $lead->name }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" value="{{ $lead->email }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm mb-1">Phone</label>
                <input type="text" name="phone" value="{{ $lead->phone }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Company -->
            <div>
                <label class="block text-sm mb-1">Company</label>
                <input type="text" name="company" value="{{ $lead->company }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status"
                    class="w-full border rounded-lg px-3 py-2">
                    <option value="new" {{ $lead->status=='new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ $lead->status=='contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="converted" {{ $lead->status=='converted' ? 'selected' : '' }}>Converted</option>
                </select>
            </div>

            <!-- Follow Up -->
            <div>
                <label class="block text-sm mb-1">Follow Up Date</label>
                <input type="date" name="follow_up_date" value="{{ $lead->follow_up_date }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-sm mb-1">Notes</label>
                <textarea name="notes" rows="3"
                    class="w-full border rounded-lg px-3 py-2">{{ $lead->notes }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('leads.index') }}" class="text-gray-600 hover:underline">
                    ← Back
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Update Lead
                </button>
            </div>

        </form>

    </div>

</div>

@endsection