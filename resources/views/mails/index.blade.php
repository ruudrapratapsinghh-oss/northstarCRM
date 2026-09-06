@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Inbox</h2>

        <a href="{{ route('mails.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
           + Compose
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search mails..."
            value="{{ request('search') }}"
            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
    </form>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-left">To</th>
                    <th class="p-3 text-left">Subject</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($mails as $m)
                <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-700">

                    <td class="p-3">{{ $m->to }}</td>

                    <td class="p-3 cursor-pointer text-blue-600"
                        onclick="openModal('{{ $m->subject }}','{{ $m->message }}')">
                        {{ $m->subject }}
                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('mails.edit',$m->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                           Edit
                        </a>

                        <form action="{{ route('mails.destroy',$m->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        No mails found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $mails->links() }}
    </div>

</div>

<!-- MODAL -->
<div id="mailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

    <div class="bg-white p-6 rounded-lg w-1/2">
        <h3 id="modalSubject" class="text-lg font-bold mb-2"></h3>
        <p id="modalMessage" class="text-gray-700"></p>

        <button onclick="closeModal()"
            class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
            Close
        </button>
    </div>

</div>

<script>
function openModal(subject, message) {
    document.getElementById('modalSubject').innerText = subject;
    document.getElementById('modalMessage').innerText = message;
    document.getElementById('mailModal').classList.remove('hidden');
    document.getElementById('mailModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('mailModal').classList.add('hidden');
}
</script>

@endsection