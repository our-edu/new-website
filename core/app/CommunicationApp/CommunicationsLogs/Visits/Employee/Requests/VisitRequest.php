<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Visits\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class VisitRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'parent_national_id'  => 'required|exists:users,national_id',
            'reason'       => 'required|string',
            'date'         => 'required|date',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'reason' => trans('visits.fields.reason'),
            'parent_uuid' => trans('visits.fields.parent_uuid'),
            'date' => trans('visits.fields.date')
        ];
    }
}
