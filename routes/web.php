<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified-or-admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // leads routs
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export');
    Route::resource('leads', LeadController::class);
    // quotation routs
    Route::resource('quotations', QuotationController::class);
    Route::resource('mails', MailController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
