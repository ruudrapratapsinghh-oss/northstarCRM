<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Northstar CRM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .welcome-grid { background-image: linear-gradient(rgba(148,163,184,.12) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,.12) 1px, transparent 1px); background-size: 36px 36px; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden bg-slate-950 text-white">
    <main class="welcome-grid relative min-h-screen">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_75%_20%,rgba(14,165,233,.18),transparent_32%),radial-gradient(circle_at_15%_80%,rgba(16,185,129,.12),transparent_28%)]"></div>
        <div class="relative mx-auto flex min-h-screen max-w-7xl flex-col px-6 py-6 lg:px-10">
            <header class="flex items-center justify-between">
                <a href="{{ url('/') }}" class="font-display text-xl font-bold tracking-tight">Northstar<span class="text-sky-400">.</span></a>
                <nav class="flex items-center gap-2 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-xl bg-sky-400 px-4 py-2.5 font-semibold text-slate-950 transition hover:bg-sky-300">Open workspace</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl px-4 py-2.5 font-semibold text-slate-300 transition hover:bg-white/10 hover:text-white">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-xl bg-white px-4 py-2.5 font-semibold text-slate-950 transition hover:bg-sky-100">Create account</a>
                        @endif
                    @endauth
                </nav>
            </header>

            <section class="flex flex-1 items-center py-20 lg:py-24">
                <div class="grid w-full items-center gap-16 lg:grid-cols-[1.05fr_.95fr]">
                    <div>
                        <p class="mb-6 inline-flex items-center gap-2 rounded-full border border-sky-400/30 bg-sky-400/10 px-3 py-1.5 text-xs font-bold uppercase tracking-[.18em] text-sky-300"><span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>Customer operations, clarified</p>
                        <h1 class="font-display max-w-3xl text-5xl font-bold leading-[1.02] tracking-tight sm:text-7xl">Turn every relationship into <span class="text-sky-400">forward motion.</span></h1>
                        <p class="mt-7 max-w-xl text-lg leading-8 text-slate-400">Northstar brings leads, follow-ups, quotations, and customer context into one focused workspace built for teams that move quickly.</p>
                        <div class="mt-9 flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="rounded-xl bg-sky-400 px-5 py-3.5 text-sm font-bold text-slate-950 shadow-xl shadow-sky-950/30 transition hover:bg-sky-300">Go to dashboard <span aria-hidden="true">→</span></a>
                            @else
                                <a href="{{ route('login') }}" class="rounded-xl bg-sky-400 px-5 py-3.5 text-sm font-bold text-slate-950 shadow-xl shadow-sky-950/30 transition hover:bg-sky-300">Sign in to workspace <span aria-hidden="true">→</span></a>
                            @endauth
                            <a href="#capabilities" class="rounded-xl border border-white/15 px-5 py-3.5 text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:bg-white/10">Explore capabilities</a>
                        </div>
                    </div>

                    <div id="capabilities" class="relative">
                        <div class="rounded-3xl border border-white/10 bg-white/[.06] p-4 shadow-2xl shadow-sky-950/30 backdrop-blur">
                            <div class="rounded-2xl border border-white/10 bg-slate-900/90 p-6">
                                <div class="flex items-center justify-between border-b border-white/10 pb-5"><div><p class="text-xs font-semibold uppercase tracking-[.18em] text-slate-500">Pipeline pulse</p><p class="mt-2 font-display text-2xl font-bold">A clearer week ahead</p></div><span class="rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-bold text-emerald-300">Live</span></div>
                                <div class="mt-6 grid grid-cols-3 gap-3"><div class="rounded-xl bg-white/5 p-4"><p class="text-xs text-slate-500">Leads</p><p class="mt-2 text-2xl font-bold">24</p></div><div class="rounded-xl bg-white/5 p-4"><p class="text-xs text-slate-500">Contacted</p><p class="mt-2 text-2xl font-bold text-amber-300">12</p></div><div class="rounded-xl bg-white/5 p-4"><p class="text-xs text-slate-500">Won</p><p class="mt-2 text-2xl font-bold text-emerald-300">08</p></div></div>
                                <div class="mt-6 space-y-4"><div class="flex items-center gap-3"><span class="h-9 w-9 rounded-xl bg-sky-400/15 text-center leading-9 text-sky-300">↗</span><div class="flex-1"><div class="flex justify-between text-sm"><span>New opportunities</span><span class="text-slate-500">72%</span></div><div class="mt-2 h-2 rounded-full bg-white/10"><div class="h-2 w-[72%] rounded-full bg-sky-400"></div></div></div></div><div class="flex items-center gap-3"><span class="h-9 w-9 rounded-xl bg-emerald-400/15 text-center leading-9 text-emerald-300">✓</span><div class="flex-1"><div class="flex justify-between text-sm"><span>Conversion momentum</span><span class="text-slate-500">54%</span></div><div class="mt-2 h-2 rounded-full bg-white/10"><div class="h-2 w-[54%] rounded-full bg-emerald-400"></div></div></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="flex flex-col gap-3 border-t border-white/10 py-6 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between"><span>One workspace for your customer relationships.</span><span>Secure access · Clear ownership · Measurable momentum</span></footer>
        </div>
    </main>
</body>
</html>
