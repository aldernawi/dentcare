<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserStatus;

class StatusController extends Controller
{
    public function index()
    {
        $status = UserStatus::latest()->get();

        return response()->json([
            'status' => $status,
        ], 200);
    }
}
