<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'start_time' => 'required|date_format:Y-m-d\TH:i|after:tomorrow',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'start_bid' => 'required|numeric',
            'minimum_bid' => 'required|numeric',
        ];
    }
}
