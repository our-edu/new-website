<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Researches\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'research_content' => 'required',
        ];
    }

    public function getImageData()
    {
        $directory_path = explode('/' . basename($this->input('image_url')), $this->input('image_url'))[0];
        return  basename($directory_path)."/".basename($this->input('image_url'));
    }
}
