<?php

// app/Http/Controllers/ConversationController.php

namespace App\Http\Controllers\api;

use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Conv as Conversation;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;


        $conversations = Conversation::where('user_id', $userId)->latest()
            ->with('user', 'doctor')
            ->get();

        return response()->json($conversations);
    }
    public function conversationsDoctorStore(Request $request)
    {

        $doctorid = $request->user()->id;
        $conv =  Conversation::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'doctor_id' => $doctorid
            ]
        );
        return  response()->json(200);
    }
    public function convDoctor()
    {
        $doctorid = Auth::user()->id;

        $conversations = Conversation::where('doctor_id', $doctorid)->latest()
            ->with('user', 'doctor')
            ->get();

        return response()->json($conversations);
    }
    public function store(Request $request)
    {
        $userId = $request->user()->id;

        Conversation::updateOrCreate([
            'user_id' => $userId,
            'doctor_id' => $request->doctor_id
        ]);


        return response()->json(['success' => true], 200);
    }

    public function conversationsDoctor($userid, $doctorid)
    {
        $conv =  Conversation::updateOrCreate(
            [
                'user_id' => $userid,
                'doctor_id' => $doctorid
            ]
        );

        $messages = Message::where('conv_id', $conv->id)->get();

        return response()->json($messages);
    }


    public function convDelete($id)
    {
        Conversation::find($id)->delete();

        return response()->json(['message' => 'success'], 200);
    }
}
