<?php

namespace App\Http\Requests\Trader;

use Illuminate\Foundation\Http\FormRequest;

class PackagesRequest extends FormRequest
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
            "title" => "required|string", 
            "description" => "nullable|string|max:255", 
            "service" => "required|string", 
            "roi" => "required|numeric|min:5|max:50", 
            "duration" => "required|numeric|min:7|max:30", 
            "minimum_amount" => "required|numeric", 
            "maximum_amount" => "required|numeric",
            "other" => "nullable|string" 
        ]; 
    } 
} 