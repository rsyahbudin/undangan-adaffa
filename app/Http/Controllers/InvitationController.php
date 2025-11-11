<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvitationController extends Controller
{
    public function show($session, $guestSlug)
    {
        $guest = Guest::where('session', $session)
            ->where('slug', $guestSlug)
            ->with(['wedding.settings', 'wedding.galleries' => function ($query) {
                $query->orderBy('created_at', 'asc')->limit(10); // Limit galleries for performance
            }])
            ->firstOrFail();

        $wedding = $guest->wedding;
        $settings = $wedding->settings;
        $galleries = $wedding->galleries;

        // Bagikan ke semua view termasuk layout
        view()->share('settings', $settings);

        return view('invitation.show', compact('guest', 'wedding', 'settings', 'galleries'));
    }

    public function rsvp(Request $request, $session, $guestSlug)
    {
        $guest = Guest::where('session', $session)
            ->where('slug', $guestSlug)
            ->firstOrFail();

        $validated = $request->validate([
            'is_attending' => 'required|boolean',
            'message' => 'nullable|string|max:1000',
        ]);

        // Set attending_count to 0 as requested
        $validated['attending_count'] = 0;

        // Simpan atau update RSVP
        $rsvp = Rsvp::updateOrCreate(
            ['guest_id' => $guest->id],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'RSVP berhasil disimpan',
            'data' => $rsvp,
        ]);
    }
}
