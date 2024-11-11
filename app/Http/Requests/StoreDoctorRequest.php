<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'email' => 'required|email|unique:doctors,email',
            'cv' => 'required|file|mimes:pdf|max:2024',

            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'service' => 'required|exists:services,id'
        ];
    }
}
