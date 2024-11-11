<?php

namespace App\Http\Controllers\api;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\card;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDoctorHomeData()
    {
        $doctorId = Auth::user()->id;
        $workSchedules = Schedule::where('doctor_id', $doctorId)->get();
        $reservations = card::where('doctor_id', $doctorId)->whereStatus(1)->take(5)->latest()->get();

        return response()->json([

            'workSchedules' => $workSchedules,
            'reservations' => $reservations,
        ], 200);
    }
}
