<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CensorRequest extends FormRequest
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
            'content' => 'required|min:10',
            'listing_id' => 'required',
            'commentable_type' => 'required',
            'commentable_id' => 'required',
        ];
    }
}
