<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RSVP;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class RSVPController extends Controller
{
    /**
     * Store a newly created RSVP.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'wedding_id' => 'required|exists:weddings,id',
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
                'attendance_status' => 'required|in:attending,not_attending,maybe',
                'guest_count' => 'required|integer|min:1',
                'message' => 'nullable|string|max:1000',
                'attendance_date' => 'nullable|date',
            ]);

            $rsvp = RSVP::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'RSVP submitted successfully',
                'data' => $rsvp
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit RSVP'
            ], 500);
        }
    }

    /**
     * Submit RSVP by invitation code.
     */
    public function submitByInvitationCode(Request $request, string $invitationCode): JsonResponse
    {
        try {
            $wedding = Wedding::where('invitation_code', $invitationCode)
                ->where('is_active', true)
                ->first();

            if (!$wedding) {
                return response()->json([
                    'success' => false,
                    'message' => 'Wedding invitation not found'
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
                'attendance_status' => 'required|in:attending,not_attending,maybe',
                'guest_count' => 'required|integer|min:1',
                'message' => 'nullable|string|max:1000',
                'attendance_date' => 'nullable|date',
            ]);

            $validated['wedding_id'] = $wedding->id;
            $rsvp = RSVP::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'RSVP submitted successfully',
                'data' => $rsvp
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit RSVP'
            ], 500);
        }
    }

    /**
     * Get RSVPs for a specific wedding.
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

        $rsvps = RSVP::where('wedding_id', $wedding->id)
            ->where('is_confirmed', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $rsvps
        ]);
    }
}
