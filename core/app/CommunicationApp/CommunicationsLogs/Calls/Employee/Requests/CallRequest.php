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
            'parent_national_id' => trans('calls.fields.parent_national_id'),
            'date' => trans('calls.fields.date'),
            'procedure' => trans('calls.fields.procedure')
        ];
    }
}
