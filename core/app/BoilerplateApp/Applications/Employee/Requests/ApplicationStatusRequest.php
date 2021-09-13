<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class ApplicationStatusRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason'=>'required|string|max:120'
        ];
    }

    public function attributes()
    {
        return [
            'reason' => trans('applications.fields.reason')
        ];
    }
}
