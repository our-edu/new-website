<?php

namespace App\NewWebsiteApp\Admin\Videos\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVideosRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'video_url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'description.required' => 'الوصف مطلوب',
            'video_url.required' => 'هذا الحقل مطلوب',
        ];
    }
}
