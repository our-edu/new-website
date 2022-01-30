<?php

declare(strict_types = 1);

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

    public function getImageData()
    {
        if ($this->has('image_url') && !empty($this->input('image_url'))) {
            $directory_path = explode('/' . basename($this->input('image_url')), $this->input('image_url'))[0];
            return basename($directory_path) . "/" . basename($this->input('image_url'));
        }
    }

    public function getFileData()
    {
        if ($this->has('bookpdf') && !empty($this->input('bookpdf'))) {
            $directory_path = explode('/' . basename($this->input('bookpdf')), $this->input('bookpdf'))[0];
            return basename($directory_path) . "/" . basename($this->input('bookpdf'));
        }
    }
}
