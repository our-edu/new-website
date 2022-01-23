<?php

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
}
