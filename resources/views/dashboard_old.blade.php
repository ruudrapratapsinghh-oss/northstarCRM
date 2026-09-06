<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <!-- Total Leads -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                <h3 class="text-gray-500">Total Leads</h3>
                <p class="text-2xl font-bold">{{ $total }}</p>
            </div>

            <!-- New -->
            <div class="bg-blue-500 text-white p-4 rounded shadow">
                <h3>New</h3>
                <p class="text-2xl font-bold">{{ $new }}</p>
            </div>

            <!-- Contacted -->
            <div class="bg-yellow-500 text-white p-4 rounded shadow">
                <h3>Contacted</h3>
                <p class="text-2xl font-bold">{{ $contacted }}</p>
            </div>

            <!-- Converted -->
            <div class="bg-green-600 text-white p-4 rounded shadow">
                <h3>Converted</h3>
                <p class="text-2xl font-bold">{{ $converted }}</p>
            </div>

        </div>

    </div>
</x-app-layout>