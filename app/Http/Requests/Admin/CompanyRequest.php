<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'nullable|string',
            'map' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'wallet_balance' => 'required|string',
            'facebook' => 'nullable|string|url',
            'twitter' => 'nullable|string|url',
            'instagram' => 'nullable|string|url',
            'linkedin' => 'nullable|string|url',
            'youtube' => 'nullable|string|url'
        ];
    }
}
