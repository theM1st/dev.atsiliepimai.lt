<?php

namespace App\Http\Requests\Admin;

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
            'review_title' => 'required_with:review_description|min:10|max:80',
            'review_description' => 'required_with:review_title|min:50',
            //'rating' => 'required_with:review_title,review_description|integer',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }
}
