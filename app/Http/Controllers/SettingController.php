<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Wedding;
use Illuminate\Http\Request;

class SettingController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wedding $wedding)
    {
        $validated = $request->validate([
            'cover_photo' => 'nullable|image|max:2048',
            'music_path' => 'nullable|mimes:mp3,wav,ogg|max:5120',
            'theme_color' => 'nullable|string',
        ]);

        if ($request->hasFile('cover_photo')) {
            $validated['cover_photo'] = $request->file('cover_photo')->store('covers', 'public');
        }

        if ($request->hasFile('music_path')) {
            $validated['music_path'] = $request->file('music_path')->store('music', 'public');
        }

        $wedding->settings()->updateOrCreate(
            ['wedding_id' => $wedding->id],
            $validated
        );

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }


    public function getSettings($wedding_id)
    {
        $settings = Setting::where('wedding_id', $wedding_id)->get();
        return response()->json($settings);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
