<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Rsvp;
use App\Models\Wedding;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvitationController extends Controller
{
    public function show($session)
    {
        // Cari wedding berdasarkan session dari guest yang ada
        $wedding = Wedding::whereHas('guests', function ($query) use ($session) {
            $query->where('session', $session);
        })->with(['settings', 'galleries' => function ($query) {
            $query->orderBy('created_at', 'asc'); // Load all galleries to ensure video is included
        }])->first();

        if (!$wedding) {
            abort(404, 'Session not found');
        }

        $settings = $wedding->settings;
        $galleries = $wedding->galleries;

        // Bagikan ke semua view termasuk layout
        view()->share('settings', $settings);

        return view('invitation.show', compact('wedding', 'settings', 'galleries', 'session'));
    }

    public function rsvp(Request $request, $session)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_attending' => 'required|boolean',
            'message' => 'nullable|string|max:1000',
        ]);

        // Set attending_count to 0 as requested
        $validated['attending_count'] = 0;

        // Simpan RSVP baru tanpa guest_id
        $rsvp = Rsvp::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'RSVP berhasil disimpan',
            'data' => $rsvp,
        ]);
    }
}
