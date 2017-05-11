<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatsRequest extends FormRequest
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
            'name' => 'required|min:5|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục tin',
            'name.min' => 'Vui lòng nhập tên danh mục tin tối thiểu 5 ký tự',
            'name.max' => 'Vui lòng nhập tên danh mục tin tối đa 100 ký tự',
        ];
    }
}
