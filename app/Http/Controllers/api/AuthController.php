<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'birth' => 'required',
                'gender' => 'required|string|in:male,female',
                'status' => 'required|exists:user_statuses,id',

            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $imageName);
                $request['img'] = $imageName;
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birth' => $request->birth,
                'gender' => $request->gender,
                'status' => $request->status,
                'img' =>  $request['img'] ?? 'empty.png'
            ]);

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user_type' => 'user',
                'user' => $user->name,
                'img' => $user->img,l

            ], 200);
        }


        if (Auth::guard('doctor')->attempt($request->only('email', 'password'))) {
            $doctor = Auth::guard('doctor')->user();
            $token = $doctor->createToken('token-doctor')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user_type' => 'doctor',
                'user' => $doctor->name,
                'img' => $doctor->img,

            ], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function update(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }



        $user->name = $request->name ?? $user->name;
        if (Auth::guard('web')->check()) {
            $user->status = $request->status_id ??  $user->status;
        }


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function uploadimage(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users/'), $imageName);
                $user->img =  $imageName;
                $user->save();
                return response()->json([
                    'message' => 'User updated successfully',
                    'image' => 'http://10.0.2.2:8000/images/users/' .  $user->img
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
