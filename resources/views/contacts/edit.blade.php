@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Edit Contact</h2>

        <form method="POST" action="{{ route('contacts.update',$contact->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="text-sm">Name</label>
                    <input type="text" name="name"
                        value="{{ $contact->name }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        value="{{ $contact->email }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Phone</label>
                    <input type="text" name="phone"
                        value="{{ $contact->phone }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm">Company</label>
                    <input type="text" name="company"
                        value="{{ $contact->company }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('contacts.index') }}" class="text-gray-500 hover:underline">
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