<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
        $doctor = $this->route('doctor');
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'service' => 'required|exists:services,id',

            'cv' => 'file|mimes:pdf|max:2024',
        ];
        if (request()->filled('password')) {
            $rules['password'] = 'required';
        }



        return $rules;
    }
}
