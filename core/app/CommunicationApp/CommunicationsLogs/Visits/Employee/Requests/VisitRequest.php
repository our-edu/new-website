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
            'procedure' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'reason' => trans('visits.fields.reason'),
            'parent_national_id' => trans('visits.fields.parent_national_id'),
            'date' => trans('visits.fields.date'),
            'procedure' => trans('visits.fields.procedure')
        ];
    }
}
