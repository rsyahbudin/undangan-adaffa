<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WeddingController extends Controller
{
    /**
     * Display a listing of active weddings.
     */
    public function index(): JsonResponse
    {
        $weddings = Wedding::where('is_active', true)
            ->with(['couple', 'schedules', 'media', 'guests'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $weddings
        ]);
    }

    /**
     * Display the specified wedding by invitation code.
     */
    public function show(string $invitationCode): JsonResponse
    {
        $wedding = Wedding::where('invitation_code', $invitationCode)
            ->where('is_active', true)
            ->with([
                'couple',
                'schedules' => function ($query) {
                    $query->where('is_active', true)->orderBy('date')->orderBy('start_time');
                },
                'media' => function ($query) {
                    $query->where('is_active', true)->orderBy('sort_order');
                },
                'guests' => function ($query) {
                    $query->where('is_active', true)->orderBy('name');
                },
                'rsvps' => function ($query) {
                    $query->where('is_confirmed', true);
                }
            ])
            ->first();

        if (!$wedding) {
            return response()->json([
                'success' => false,
                'message' => 'Wedding invitation not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $wedding
        ]);
    }
}
