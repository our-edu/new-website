<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Videos\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideosRequest extends FormRequest
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
    public function getImageData()
    {
        $directory_path = explode('/' . basename($this->input('image_url')), $this->input('image_url'))[0];
        return  basename($directory_path)."/".basename($this->input('image_url'));
    }
}
