<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'fullname' => 'required|min:5|max:30',
            'capbac' => 'required|integer',
            'email' => 'required|min:5|max:30|email',
            'password' => 'min:5|max:30',
            'picture' => 'mimes:jpg,jpeg,bmp,png|max:3072',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập username',
            'username.min'  => 'Vui lòng nhập username tối thiểu 5 ký tự',
            'username.max'  => 'Vui lòng nhập username tối đa 30 ký tự',

            'fullname.required' => 'Vui lòng nhập fullname',
            'fullname.min'  => 'Vui lòng nhập fullname tối thiểu 5 ký tự',
            'fullname.max'  => 'Vui lòng nhập fullname tối đa 30 ký tự',

            'capbac.required' => 'Vui lòng chọn cấp bậc',
            'capbac.integer' => 'Giá trị cấp bậc là định dạng số',

            'email.required' => 'Vui lòng nhập email',
            'email.min'  => 'Vui lòng nhập email tối thiểu 5 ký tự',
            'email.max'  => 'Vui lòng nhập email tối đa 30 ký tự',
            'email.email'  => 'Vui lòng nhập đúng định dạng email',
            
            'password.min'  => 'Vui lòng nhập password tối thiểu 5 ký tự',
            'password.max'  => 'Vui lòng nhập password tối đa 30 ký tự',

            'picture.max' => 'Kích thước ảnh tối đa 3MB',
            'picture.mimes' => 'Vui lòng chọn ảnh đuôi jpg, jpeg, bmp, png'  
        ];
    }
}
