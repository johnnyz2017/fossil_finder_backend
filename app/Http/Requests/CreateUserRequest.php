<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:34|alpha_dash',
            'email' => 'required|min:5|max:34|unique:users|email',
            'password' => 'nullable|min:8|max:32|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Username required.',
            'name.min' => 'Username needs to be above 1',
            'name.max' => 'Username needs to be below 35',
            'email.required' => 'Email required.',
            'email.unique' => 'Email already in use.',
            'email.email' => 'Email needs to be a email format.',
            'email.min' => 'Email needs to be above 5',
            'email.max' => 'Email needs to be below 35',
            'password.min' => 'Password needs to be above 7',
            'password.max' => 'Username needs to be below 35',
        ];
    }
}
