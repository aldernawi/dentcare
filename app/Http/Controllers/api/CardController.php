<?php

namespace App\Http\Controllers\api;

use App\Models\card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conv;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function card(Request $request)
    {

        return response()->json($request->user()->card->load('doctor'));
    }


    public function delete($id)
    {
        $card =  card::find($id);
        if (!$card) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found'
            ], 404);
        }

        $card->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservation deleted successfully'
        ], 200);
    }

    public function DoctorCardUpdate($id)
    {
        card::findOrFail($id)->update(['status' => 2]);


        return response()->json(['message' => 'Order update successfully'], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'doctorId' => 'required|integer|exists:doctors,id',
        ]);

        $user = Auth::user();
        card::updateOrCreate([
            'user_id' => $user->id,
            'doctor_id' => $request->doctorId
        ]);


        return response()->json(['message' => 'Order created successfully'], 201);
    }

    public function DoctorCard()
    {
        $doctor = Auth::user()->id;
        $reservations = card::where('doctor_id', $doctor)->whereStatus(1)->with('user')->latest()->get();
        $conversations = Conv::where('doctor_id', $doctor)
            ->latest()
            ->get();


        return response()->json([
            'reservations' => $reservations,
            'conversations' => $conversations,
        ]);
    }
}
