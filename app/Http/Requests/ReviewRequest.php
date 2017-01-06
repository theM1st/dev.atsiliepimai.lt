<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'review_title' => 'sometimes|required|min:10|max:80',
            'review_description' => 'sometimes|required|min:50',
            'rating' => 'sometimes|required|integer|min:1',
            'attribute_option_id.*' => 'sometimes|required',
            'option_value' => 'sometimes|required',
        ];
    }
}
