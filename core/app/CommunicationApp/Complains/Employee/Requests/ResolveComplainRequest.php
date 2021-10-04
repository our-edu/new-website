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
                "status" => 'required|in:'.ComplainStatusesEnum::RESOLVED_EN,
                "procedure" => 'required'
            ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'status' => trans('complains.fields.status'),
        ];
    }
}
