<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'sometimes|required|email|max:255|unique:users,email,'.$this->segment(3),
            'username' => 'sometimes|required|max:255',
            'password' => 'sometimes|required|min:6|max:50|confirmed',
            'telephone' => 'regex:/[0-9\-\+]{6,}/',
            'city' => 'alpha',
            'picture' => 'file|image',
        ];
    }
}
