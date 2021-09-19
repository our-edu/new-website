<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class ComplainRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'parent_uuid' => 'required|exists:parent_users,uuid',
            'student_uuid' => 'required|exists:students,uuid',
            'body'         => 'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'body' => trans('complains.fields.body'),
            'parent_uuid' => trans('complains.fields.parent_uuid'),
            'student_uuid' => trans('complains.fields.student_uuid')
        ];
    }
}
