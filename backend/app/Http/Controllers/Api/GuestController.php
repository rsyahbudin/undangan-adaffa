<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Get all guests by wedding invitation code.
     */
    public function getByWedding(string $invitationCode): JsonResponse
    {
        $wedding = Wedding::where('invitation_code', $invitationCode)
            ->where('is_active', true)
            ->first();

        if (!$wedding) {
            return response()->json([
                'success' => false,
                'message' => 'Wedding invitation not found'
            ], 404);
        }

        $guests = Guest::where('wedding_id', $wedding->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $guests
        ]);
    }

    /**
     * Get guests by session.
     */
    public function getBySession(string $invitationCode, string $session): JsonResponse
    {
        $wedding = Wedding::where('invitation_code', $invitationCode)
            ->where('is_active', true)
            ->first();

        if (!$wedding) {
            return response()->json([
                'success' => false,
                'message' => 'Wedding invitation not found'
            ], 404);
        }

        $guests = Guest::where('wedding_id', $wedding->id)
            ->where('is_active', true)
            ->where(function ($query) use ($session) {
                $query->where('session', $session)
                    ->orWhere('session', 'both');
            })
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $guests
        ]);
    }
}
