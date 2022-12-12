<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTraderRequest extends FormRequest
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
            "firstname" => 'required|string|max:255',
            "lastname" => 'required|string|max:255',
            "email" => 'required|string|email|max:255',
            "phone" => 'nullable|string',
            "gender" => 'nullable|string',
            "profile_img" => 'nullable|mimes: png, jpg, jpeg|max:2048',
            "nationality" => 'nullable|string|max:255',
            "percentage" => 'nullable|numeric|min:0|max:100',
            "expertise" => 'nullable|string|max:1000',
            "admin_rating" => 'nullable|numeric|min:0|max:5',
            'show_admin_rating' => 'nullable|in:0,1',
            "liquidity" => 'nullable|string|max:255',
            "liquidity_amt" => 'nullable|numeric',
        ];
    }
}
