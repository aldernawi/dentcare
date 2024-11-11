<?php

namespace App\Http\Requests;

use App\Enums\Days;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'day' => ['required', new Enum(Days::class)],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'doctor_id' => 'required|exists:doctors,id'
        ];
    }
}
