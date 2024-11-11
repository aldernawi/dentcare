<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        $admin = $this->route('admin');
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',

        ];
        if (request()->filled('password')) {
            $rules['password'] = 'required';
        }
        return $rules;
    }
}
