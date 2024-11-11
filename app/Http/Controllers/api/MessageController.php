<?php

namespace App\Http\Controllers\api;



use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Conv;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    public function fetchMessages($id)
    {

        $messages = Message::where('conv_id', $id)->get();

        return response()->json($messages);
    }

    public function markAsRead(Request $request, $id)
    {

        Message::where('conv_id', $id)->update(['read' => true]);

        return response()->json(['status' => 'success']);
    }

    public function sendMessage(Request $request, $id)
    {
        // تحقق من صحة الطلب
        $validated = $request->validate([
            'body' => 'required|string',
            'is_doctor' => 'required|boolean',
        ]);

        try {

            $message = new Message();

            $message->body = $request->input('body');

            $message->is_doctor = $request->input('is_doctor');

            $message->user_id =   Auth::user()->id;

            $message->doctor_id = $request->doctor_id;

            $message->conv_id = $id;

            $message->save();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // تسجيل الاستثناء والرد بخطأ 500
            Log::error('Error storing message: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
