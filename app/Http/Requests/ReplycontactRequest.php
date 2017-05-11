<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplycontactRequest extends FormRequest
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
            'email' => 'required|min:10|max:100',
            'detail' => 'required|min:10|max:10000',
            'title' => 'required|min:10|max:100',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.min' => 'Vui lòng nhập email tối thiểu 10 ký tự',
            'email.max' => 'Vui lòng nhập email tối đa 100 ký tự',

            'detail.required' => 'Vui lòng nhập nội dung liên hệ',
            'detail.min' => 'Vui lòng nhập nội dung liên hệ tối thiểu 10 ký tự',
            'detail.max' => 'Vui lòng nhập nội dung liên hệ tối đa 10000 ký tự',

            'title.required' => 'Vui lòng nhập tiêu đề liên hệ',
            'title.min' => 'Vui lòng nhập tiêu đề liên hệ tối thiểu 10 ký tự',
            'title.max' => 'Vui lòng nhập tiêu đề liên hệ tối đa 100 ký tự',
        ];
    }
}
