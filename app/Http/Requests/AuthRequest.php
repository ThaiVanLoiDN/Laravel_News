<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'username' => 'required|min:5|max:30',
            'password' => 'required|min:5|max:30',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập username',
            'username.min'  => 'Vui lòng nhập username tối thiểu 5 ký tự',
            'username.max'  => 'Vui lòng nhập username tối đa 30 ký tự',

            'password.required' => 'Vui lòng nhập password',
            'password.min'  => 'Vui lòng nhập password tối thiểu 5 ký tự',
            'password.max'  => 'Vui lòng nhập password tối đa 30 ký tự',
        ];
    }
}
