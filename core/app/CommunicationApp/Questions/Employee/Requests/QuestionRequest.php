<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class QuestionRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'ar.body' => 'required|min:10',
            'en.body' => 'required|min:10',
            'active' => 'required|bool'

        ];
    }

    public function attributes()
    {
        return [
            'ar.body' => trans('questions.fields.body_ar'),
            'en.body' => trans('questions.fields.body_en'),
            'active' => trans('questions.fields.active')
        ];
    }
}
