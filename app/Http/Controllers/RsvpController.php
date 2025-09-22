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
    public function store(Request $request, $guestId)
    {
        $guest = Guest::findOrFail($guestId);

        $validated = $request->validate([
            'is_attending'    => 'required|boolean',
            'attending_count' => 'nullable|integer|min:0',
            'message'         => 'nullable|string|max:1000',
        ]);

        // Jika tidak hadir → otomatis attending_count = 0
        if (!$validated['is_attending']) {
            $validated['attending_count'] = 0;
        }

        // Simpan atau update RSVP
        $rsvp = Rsvp::updateOrCreate(
            ['guest_id' => $guest->id],
            $validated
        );

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
