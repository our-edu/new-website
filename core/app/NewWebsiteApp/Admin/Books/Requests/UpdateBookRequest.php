<?php

namespace App\NewWebsiteApp\Admin\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'description' => 'required',
            'publish_date' => 'required',
            'author' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'description.required' => 'الوصف مطلوب',
            'publish_date.required' => 'هذا الحقل مطلوب',
            'author.required' => 'هذا الحقل مطلوب',
        ];
    }
}
