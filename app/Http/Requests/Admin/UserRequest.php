<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $segments = count($this->segments());
        if ($this->segment($segments)) {
            $emailUniqueRule = Rule::unique('users')->ignore($this->segment($segments));
        } else {
            $emailUniqueRule = Rule::unique('users');
        }

        return [
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:50',
                $emailUniqueRule,
            ],
            'username' => 'sometimes|required|max:255',
            'password' => 'sometimes|required|min:6|max:50|confirmed',
            'current_password' => 'sometimes|required|min:6|max:50|check_password',
            'telephone' => 'regex:/[0-9\-\+]{6,}/',
            'city' => 'alpha',
            'picture' => 'file|image',
        ];
    }
}
