<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Calls\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class CallRequest extends BaseApiRequest
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
            'reason' => trans('calls.fields.reason'),
            'parent_uuid' => trans('calls.fields.parent_uuid'),
            'date' => trans('calls.fields.date'),
            'procedure' => trans('calls.fields.procedure')
        ];
    }
}
