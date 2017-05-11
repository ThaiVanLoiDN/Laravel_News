<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'name' => 'required|min:10|max:100',
            'cat_id' => 'required|integer',
            'preview' => 'required|min:10|max:500',
            'detail' => 'required|min:10|max:100000',
            'picture' => 'mimes:jpg,jpeg,bmp,png|max:3072',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên bài viết',
            'name.min' => 'Vui lòng nhập tên bài viết tối thiểu 10 ký tự',
            'name.max' => 'Vui lòng nhập tên bài viết tối đa 100 ký tự',

            'cat_id.required' => 'Vui lòng chọn chuyên mục',
            'cat_id.integer' => 'Giá trị chuyên mục là định dạng số',

            'preview.required' => 'Vui lòng nhập mô tả bài viết',
            'preview.min' => 'Vui lòng nhập mô tả bài viết tối thiểu 10 ký tự',
            'preview.max' => 'Vui lòng nhập mô tả bài viết tối đa 500 ký tự',

            'detail.required' => 'Vui lòng nhập nội dung bài viết',
            'detail.min' => 'Vui lòng nhập nội dung bài viết tối thiểu 10 ký tự',
            'detail.max' => 'Vui lòng nhập nội dung bài viết tối đa 100000 ký tự',

            'picture.max' => 'Kích thước ảnh tối đa 3MB',
            'picture.mimes' => 'Vui lòng chọn ảnh đuôi jpg, jpeg, bmp, png'  
        ];
    }
}
