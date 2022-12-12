<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KycRequest extends FormRequest
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
            'id_type' => 'required|string',
            'id_number' => 'required|string',
            'id_issue_date' => 'required|date',
            'id_expiry_date' => 'required|date',
            'front_view' => 'required|mimes:png,jpg,jpeg|max:2048',
            'rear_view' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}