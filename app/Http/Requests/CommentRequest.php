<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'hoten' => 'required|min:5|max:40',
            'email' => 'required|min:5|max:40',
            'content' => 'required|min:5|max:200',
        ];
    }

    public function messages()
    {
        return [
            'hoten.required' => 'Vui lòng nhập họ tên',
            'hoten.min' => 'Vui lòng nhập họ tên tối thiểu 5 ký tự',
            'hoten.max' => 'Vui lòng nhập họ tên tối đa 40 ký tự',

            'email.required' => 'Vui lòng nhập email',
            'email.min' => 'Vui lòng nhập email tối thiểu 5 ký tự',
            'email.max' => 'Vui lòng nhập email tối đa 40 ký tự',

            'content.required' => 'Vui lòng nhập nội dung',
            'content.min' => 'Vui lòng nhập nội dung tối thiểu 5 ký tự',
            'content.max' => 'Vui lòng nhập nội dung tối đa 200 ký tự',
        ];
    }
}
