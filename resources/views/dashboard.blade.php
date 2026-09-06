
@extends('layouts.app')

@section('title', 'Overview')
@section('header', 'Good morning, ' . auth()->user()->name)

@section('content') 

    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div><p class="text-sm font-medium text-sky-600 dark:text-sky-400">Pipeline snapshot</p><h1 class="mt-1 font-display text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Your sales, at a glance.</h1><p class="mt-2 text-sm text-slate-500">Track momentum and follow up with the opportunities that matter.</p></div>
            <a href="{{ route('leads.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-950/10 transition hover:bg-sky-600 dark:bg-sky-500 dark:text-slate-950">+ Add lead</a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <!-- Total Leads -->
            <div class="app-card p-5">
                <p class="text-sm font-medium text-slate-500">Total leads</p>
                <p class="mt-3 font-display text-3xl font-bold text-slate-900 dark:text-white">{{ $total }}</p>
                <p class="mt-2 text-xs text-slate-400">All opportunities in pipeline</p>
            </div>

            <!-- New -->
            <div class="rounded-2xl bg-sky-500 p-5 text-white shadow-lg shadow-sky-500/20">
                <p class="text-sm text-sky-100">New</p>
                <p class="mt-3 font-display text-3xl font-bold">{{ $new }}</p>
                <p class="mt-2 text-xs text-sky-100">Ready for first contact</p>
            </div>

            <!-- Contacted -->
            <div class="rounded-2xl bg-amber-400 p-5 text-slate-950 shadow-lg shadow-amber-400/20">
                <p class="text-sm text-amber-950/70">Contacted</p>
                <p class="mt-3 font-display text-3xl font-bold">{{ $contacted }}</p>
                <p class="mt-2 text-xs text-amber-950/70">Conversations in motion</p>
            </div>

            <!-- Converted -->
            <div class="rounded-2xl bg-emerald-500 p-5 text-white shadow-lg shadow-emerald-500/20">
                <p class="text-sm text-emerald-100">Converted</p>
                <p class="mt-3 font-display text-3xl font-bold">{{ $converted }}</p>
                <p class="mt-2 text-xs text-emerald-100">Won opportunities</p>
            </div>

        </div>

    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.4fr_1fr]">
        <div class="app-card p-6">
            <div class="mb-5 flex items-center justify-between"><div><h3 class="font-display text-lg font-bold text-slate-900 dark:text-white">Lead activity</h3><p class="mt-1 text-sm text-slate-500">Monthly pipeline volume</p></div><span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700 dark:bg-sky-400/10 dark:text-sky-300">This year</span></div>
            <div class="h-72"><canvas id="leadsChart"></canvas></div>
        </div>
        <div class="app-card p-6">
            <div class="mb-5 flex items-center justify-between"><div><h3 class="font-display text-lg font-bold text-slate-900 dark:text-white">Recent leads</h3><p class="mt-1 text-sm text-slate-500">Latest additions to your pipeline</p></div><a href="{{ route('leads.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-500">View all</a></div>
            <div class="space-y-4">
                @forelse ($recentLeads as $lead)
                    <a href="{{ route('leads.show', $lead) }}" class="flex items-center justify-between gap-3 rounded-xl p-2 transition hover:bg-slate-50 dark:hover:bg-slate-800"><div class="min-w-0"><p class="truncate text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $lead->name }}</p><p class="truncate text-xs text-slate-500">{{ $lead->company ?: $lead->email }}</p></div><span class="shrink-0 rounded-full bg-slate-100 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ $lead->status }}</span></a>
                @empty
                    <p class="py-8 text-center text-sm text-slate-500">No leads yet.</p>
                @endforelse
            </div>
        </div>
    </div>

<script>
const ctx = document.getElementById('leadsChart');

const data = {
    labels: @json($months),
    datasets: [{
        label: 'Leads',
        data: @json($counts),
        borderColor: '#0ea5e9',
        backgroundColor: 'rgba(14, 165, 233, 0.12)',
        fill: true,
        borderWidth: 3,
        pointRadius: 3,
        tension: 0.35
    }]
};

new Chart(ctx, {
    type: 'line',
    data: data,
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } }, x: { grid: { display: false } } } }
});
</script>

@endsection