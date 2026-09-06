@extends('layouts.app')

@section('title', 'Account settings')
@section('header', 'Account settings')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="mb-8"><p class="text-sm font-medium text-sky-600 dark:text-sky-400">Personal workspace</p><h1 class="mt-1 font-display text-3xl font-bold text-slate-900 dark:text-white">Manage your account</h1><p class="mt-2 text-sm text-slate-500">Keep your profile and sign-in details up to date.</p></div>
        <div class="app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="app-card p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="app-card border-rose-200 p-6 sm:p-8 dark:border-rose-950">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
