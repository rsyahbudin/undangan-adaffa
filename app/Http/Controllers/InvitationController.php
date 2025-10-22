<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvitationController extends Controller
{
    public function show($session, $guestSlug)
    {
        $guest = Guest::where('session', $session)
            ->where('slug', $guestSlug)
            ->with('wedding')
            ->firstOrFail();

        $wedding = $guest->wedding;
        $settings = $wedding->settings;
        $galleries = $wedding->galleries;
        $settings = $wedding->settings;

        // Bagikan ke semua view termasuk layout
        view()->share('settings', $settings);

        return view('invitation.show', compact('guest', 'wedding', 'settings', 'galleries'));
    }
}
