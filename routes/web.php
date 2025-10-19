<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RsvpController;


// Default ke undangan umum
Route::get('/', [InvitationController::class, 'default'])->name('home');

// Dashboard (opsional, jika masih pakai inertia + auth)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard'); // ganti view biasa, bukan inertia
    })->name('dashboard');
});

// Undangan tamu berdasarkan sesi + nama
Route::get('/sesi{session}/{guestSlug}', [InvitationController::class, 'show'])
    ->whereNumber('session')
    ->name('invitation.show');

Route::post('/sesi{session}/{guestSlug}/rsvp', [InvitationController::class, 'rsvp'])
    ->whereNumber('session')
    ->name('invitation.rsvp');



Route::get('/rsvp-messages', [RsvpController::class, 'index']);
Route::post('/rsvp/{guestId}', [RsvpController::class, 'store']);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
