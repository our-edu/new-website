<?php

namespace App\NewWebsiteApp\Admin\Articles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'article_content' => 'required',
        ];
    }
}
