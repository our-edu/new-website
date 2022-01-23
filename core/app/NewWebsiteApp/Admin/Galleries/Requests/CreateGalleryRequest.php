<?php

namespace App\NewWebsiteApp\Admin\Galleries\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGalleryRequest extends FormRequest
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
//            'title' => 'required|max:250',
//            'description' => 'required',
//            'content' => 'required',
        ];
    }
}
