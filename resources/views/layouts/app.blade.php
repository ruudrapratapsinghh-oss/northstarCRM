<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') · {{ config('app.name', 'CRM') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|space-grotesk:500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

<div class="min-h-screen lg:flex">

    <!-- 🔥 SIDEBAR -->
    <aside class="border-b border-slate-200 bg-slate-950 text-slate-300 lg:min-h-screen lg:w-72 lg:border-b-0 dark:border-slate-800">

        <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
            <a href="{{ route('dashboard') }}" class="font-display text-xl font-bold tracking-tight text-white">Northstar<span class="text-sky-400">.</span></a>
            <span class="rounded-full bg-sky-400/10 px-2 py-1 text-[10px] font-bold uppercase tracking-widest text-sky-300">CRM</span>
        </div>

        <nav class="space-y-1 p-4">
            @php($navItems = [
                ['route' => 'dashboard', 'label' => 'Overview', 'icon' => '⌂'],
                ['route' => 'leads.index', 'label' => 'Leads', 'icon' => '↗'],
                ['route' => 'quotations.index', 'label' => 'Quotations', 'icon' => '▤'],
                ['route' => 'mails.index', 'label' => 'Mail', 'icon' => '✉'],
                ['route' => 'activities.index', 'label' => 'Activities', 'icon' => '◷'],
                ['route' => 'contacts.index', 'label' => 'Contacts', 'icon' => '◎'],
                ['route' => 'products.index', 'label' => 'Products', 'icon' => '◇'],
            ])

            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs($item['route']) ? 'bg-sky-400 text-slate-950 shadow-lg shadow-sky-950/20' : 'text-slate-400 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/10 text-sm">{{ $item['icon'] }}</span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-8 border-t border-white/10 p-4">
            <p class="px-4 pb-3 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">Workspace</p>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/10 hover:text-white">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/10">⚙</span>
                Account settings
            </a>
        </div>

    </aside>

    <!-- 🔥 MAIN CONTENT -->
    <div class="min-w-0 flex-1">
        <!-- 🔝 TOP HEADER -->
            <header class="flex items-center justify-between border-b border-slate-200 bg-white/80 px-6 py-4 backdrop-blur dark:border-slate-800 dark:bg-slate-950/80">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">{{ now()->format('l, d F Y') }}</p>
                    <div class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">@yield('header', 'Workspace overview')</div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleDark()" class="rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-500 transition hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800" aria-label="Toggle dark mode">◐</button>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-sky-100 text-xs font-bold text-sky-700 dark:bg-sky-400/20 dark:text-sky-300">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="hidden text-left sm:block"><span class="block text-sm font-semibold text-slate-800 dark:text-white">{{ auth()->user()->name }}</span><span class="block text-xs text-slate-500">{{ auth()->user()->role }}</span></span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-xl px-3 py-2 text-sm font-semibold text-slate-500 transition hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-950/40" title="Sign out">Sign out</button>
                    </form>

                </div>

            </header>

        <!-- 📦 PAGE CONTENT -->
        <main class="p-6 lg:p-8">
            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>
            @endif
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>