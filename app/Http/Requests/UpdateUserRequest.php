<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check() || Auth::guard('doctor')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'birth' => 'required|date',
            'gender' => "required|in:Male,Female",
            'status' => 'required|exists:user_statuses,id',
        ];
        if (request()->filled('password')) {
            $rules['password'] = 'required';
        }
        return $rules;
    }
}
