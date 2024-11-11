<?php

namespace App\Http\Controllers\api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NotificationController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();

        $notifications = Notification::where('notifiable_type', 'App\Models\User')
            ->where('notifiable_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    public function doctor(Request $request)
    {
        $doctor = $request->user();

        $notifications = Notification::where('notifiable_type', 'App\Models\Doctor')
            ->where('notifiable_id', $doctor->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }
}
