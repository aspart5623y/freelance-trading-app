<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestorRequest extends FormRequest
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
            "profile_img" => 'nullable|mimes: png, jpg, jpeg|max:2048',
            "date_of_birth" => 'nullable|date',
            "nationality" => 'nullable|string',
            "address" => 'nullable|string',
        ];
    }
}
