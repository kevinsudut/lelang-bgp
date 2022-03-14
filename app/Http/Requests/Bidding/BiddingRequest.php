<?php

namespace App\Http\Requests\Bidding;

use Illuminate\Foundation\Http\FormRequest;

class BiddingRequest extends FormRequest
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
            'id' => 'required|numeric|exists:products,id',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
