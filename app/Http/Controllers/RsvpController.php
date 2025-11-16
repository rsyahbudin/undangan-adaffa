<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Guest;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $messages = Rsvp::whereNotNull('message')
            ->where('message', '!=', '')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($rsvp) {
                return [
                    'guest_name' => $rsvp->name,
                    'message' => $rsvp->message,
                    'is_attending' => (bool) $rsvp->is_attending, // ← tambahkan ini
                ];
            });

        return response()->json(['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'is_attending'    => 'required|boolean',
            'message'         => 'nullable|string|max:1000',
        ]);

        // Simpan RSVP baru
        $rsvp = Rsvp::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'RSVP berhasil disimpan',
            'data'    => $rsvp,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($guestId)
    {
        $guest = Guest::with('rsvp')->findOrFail($guestId);

        return response()->json([
            'guest' => $guest,
            'rsvp'  => $guest->rsvp,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rsvp $rsvp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rsvp $rsvp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rsvp $rsvp)
    {
        //
    }
}
