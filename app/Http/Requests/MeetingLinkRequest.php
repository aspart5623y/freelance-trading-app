<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingLinkRequest extends FormRequest
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
            // "admin_id" => "required|string",
            // "profile_id" => "required|string",
            "meeting_date" => "required|date",
            "meeting_time" => "required",
            "meeting_link" => "required|url"
        ];
    }
}
