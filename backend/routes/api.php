<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Wedding;
use App\Models\Guest;
use App\Models\Media;
use App\Models\Schedule;
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

Route::get('/invitations/{invitation_code}/{guest_token}', function (string $invitation_code, string $guest_token) {
    $wedding = Wedding::query()
        ->where('invitation_code', $invitation_code)
        ->where('is_active', true)
        ->firstOrFail();

    $guest = Guest::query()
        ->where('invite_token', $guest_token)
        ->where('wedding_id', $wedding->id)
        ->where('is_active', true)
        ->firstOrFail();

    $schedules = Schedule::query()
        ->where('wedding_id', $wedding->id)
        ->where('is_active', true)
        ->whereIn('type', match ($guest->session) {
            'session_1' => ['akad', 'resepsi_1'],
            'session_2' => ['akad', 'resepsi_2'],
            'both' => ['akad', 'resepsi_1', 'resepsi_2'],
            default => ['akad'],
        })
        ->orderBy('date')
        ->orderBy('time')
        ->get();

    $gallery = Media::query()
        ->where('wedding_id', $wedding->id)
        ->where('type', Media::TYPE_GALLERY)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get(['id', 'title', 'description', 'file_path', 'file_url']);

    $video = Media::query()
        ->where('wedding_id', $wedding->id)
        ->where('type', Media::TYPE_PREWEDDING_VIDEO)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->first(['id', 'title', 'youtube_url']);

    return response()->json([
        'wedding' => [
            'title' => $wedding->title,
            'wedding_date' => $wedding->wedding_date,
            'cover_photo' => $wedding->cover_photo,
            'background_photo' => $wedding->background_photo,
            'background_music' => $wedding->background_music,
        ],
        'guest' => [
            'name' => $guest->name,
            'session' => $guest->session,
        ],
        'schedules' => $schedules,
        'media' => [
            'gallery' => $gallery,
            'prewedding_video' => $video,
        ],
    ]);
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
