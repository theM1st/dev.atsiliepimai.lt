<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
            'title' => 'required|min:5|max:80',
            'listing_type' => 'required|in:product,service',
            'review_title' => 'sometimes|required|min:10|max:80',
            'review_description' => 'sometimes|required|min:50',
            'rating' => 'sometimes|required|integer|min:1',
            'category_id' => 'required|integer',
        ];
    }
}
