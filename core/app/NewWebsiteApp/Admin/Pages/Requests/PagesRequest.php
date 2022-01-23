<?php

namespace App\NewWebsiteApp\Admin\Pages\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'body' => 'required',
        ];
    }
}
