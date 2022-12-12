<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "firstname" => 'required|string',
            "lastname" => 'required|string',
            "email" => 'required|string|email',
            "phone" => 'nullable|string',
            "gender" => 'nullable|string',
            "date_of_birth" => 'nullable|date',
            "nationality" => 'nullable|string',
            "address" => 'nullable|string',
        ];
    }
}