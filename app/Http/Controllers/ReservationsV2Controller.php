<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class Reservationsv2Controller extends Controller
{
    public function get ($users_id)
    {
        $reservations = Reservation::getReservation($users_id);
        if ($reservations->isNotEmpty()) {
            return response()->json([
                'message' => 'Reservation gotton successfully',
                'data' => $reservations
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Reservation',
                'data' => $reservations
            ], 200);
        }
    }
    public function post ($users_id,Request $request)
    {
        $reservation = Reservation::postReservation($users_id,$request);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $reservation
        ], 201);
    }

    public function delete($users_id,Request $request)
    {
        $reservation = Reservation::deleteReservation($users_id,$request);
        if ($reservation) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not deleted,reservation not found',
            ], 404);
        }
    }
}
