<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;

class ResolveComplainRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
                "status" => 'required|in:'.ComplainStatusesEnum::RESOLVED_EN
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
