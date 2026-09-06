@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-4">Edit Mail</h2>

    <form method="POST" action="{{ route('mails.update',$mail->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm mb-1">To</label>
            <input name="to" value="{{ $mail->to }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Subject</label>
            <input name="subject" value="{{ $mail->subject }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Message</label>
            <textarea name="message" rows="5"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">{{ $mail->message }}</textarea>
        </div>

        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            Update
        </button>

    </form>

</div>

@endsection