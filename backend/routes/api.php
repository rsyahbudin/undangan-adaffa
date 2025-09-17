<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WeddingController;
use App\Http\Controllers\Api\RSVPController;
use App\Http\Controllers\Api\GuestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes for wedding invitations
Route::prefix('weddings')->group(function () {
    // Get all active weddings
    Route::get('/', [WeddingController::class, 'index']);

    // Get wedding by invitation code
    Route::get('/{invitationCode}', [WeddingController::class, 'show']);
});

// RSVP routes
Route::prefix('rsvp')->group(function () {
    // Submit RSVP by invitation code
    Route::post('/{invitationCode}', [RSVPController::class, 'submitByInvitationCode']);

    // Get RSVPs for a wedding
    Route::get('/{invitationCode}', [RSVPController::class, 'getByWedding']);

    // Submit RSVP with wedding ID (for admin use)
    Route::post('/', [RSVPController::class, 'store']);
});

// Guest routes
Route::prefix('guests')->group(function () {
    // Get all guests by wedding invitation code
    Route::get('/{invitationCode}', [GuestController::class, 'getByWedding']);

    // Get guests by session
    Route::get('/{invitationCode}/{session}', [GuestController::class, 'getBySession']);
});
