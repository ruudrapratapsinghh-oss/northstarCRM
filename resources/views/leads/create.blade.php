@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">
            Add New Lead
        </h2>

        <form method="POST" action="{{ route('leads.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm mb-1">Name</label>
                <input type="text" name="name" required
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Phone</label>
                <input type="text" name="phone"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Company</label>
                <input type="text" name="company"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status"
                    class="w-full border rounded-lg px-3 py-2">
                    <option value="new">New</option>
                    <option value="contacted">Contacted</option>
                    <option value="converted">Converted</option>
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Follow Up Date</label>
                <input type="date" name="follow_up_date"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Notes</label>
                <textarea name="notes" rows="3"
                    class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('leads.index') }}" class="text-gray-600">
                    ← Back
                </a>

                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    Save Lead
                </button>
            </div>

        </form>

    </div>

</div>

@endsection