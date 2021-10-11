<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use Illuminate\Validation\Rule;

class EventRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'ar.title' => 'required|min:10',
            'ar.body' => 'required|min:10',
            'en.title' => 'required|min:10',
            'en.body' => 'required|min:10',
            'full_day' => 'required|'.Rule::in([1, 0]),
            'start' => 'required|date|date_format:Y-m-d H:i:s|after_or_equal:today',
            'end' => 'required_if:full_day,0|date|date_format:Y-m-d H:i:s|after_or_equal:start',
            'all_branches' => 'required|'.Rule::in([1, 0]),
            'branches' => 'required_if:all_branches,0|array',
            'branches.*' => 'exists:branches,uuid',

        ];
    }

    public function attributes()
    {
        return [
            'ar.title' => trans('events.fields.title_ar'),
            'ar.body' => trans('events.fields.body_ar'),
            'en.title' => trans('events.fields.title_en'),
            'en.body' => trans('events.fields.body_en'),
            'full_day' => trans('events.fields.full_day'),
            'start' => trans('events.fields.start'),
            'end' => trans('events.fields.end'),
            'all_branches' => trans('events.fields.all_branches'),
            'branches' => trans('events.fields.branches'),
            'branches.*' => trans('events.fields.branches_item')
        ];
    }
}
