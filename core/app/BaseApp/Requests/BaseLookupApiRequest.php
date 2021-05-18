<?php

declare(strict_types = 1);

namespace App\OurEdu\BaseApp\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseLookupApiRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name:ar' => 'required|min:2|max:30',
            'name:en' => 'required|min:2|max:30',
        ];
    }
}
