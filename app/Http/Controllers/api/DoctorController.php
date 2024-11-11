<?php

namespace App\Http\Controllers\api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class DoctorController extends Controller
{


    public function getDoctorCV($doctorId)
    {

        $doctor = Doctor::find($doctorId);

        if ($doctor) {
            return response()->json(['cv' => $doctor->cv], 200);
        } else {
            return response()->json(['error' => 'Doctor CV not found'], 404);
        }
    }
}
