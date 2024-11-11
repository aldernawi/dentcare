<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'birth' => 'required|date',
            'gender' => "required|in:Male,Female",
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|exists:user_statuses,id',
        ];
    }
}
