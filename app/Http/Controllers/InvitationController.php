<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($session, $guestSlug)
    {
        // Cari guest berdasarkan session & slug langsung di DB
        $guest = Guest::where('session', $session)
            ->where('slug', $guestSlug)
            ->with('wedding') // eager load biar hemat query
            ->first();

        if (!$guest) {
            abort(404, 'Undangan tidak ditemukan.');
        }

        $wedding = $guest->wedding;
        $settings = $wedding->settings;
        $galleries = $wedding->galleries;

        return view('invitation.show', compact('guest', 'wedding', 'settings', 'galleries'));
    }
}
