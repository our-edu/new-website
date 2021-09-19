<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use Illuminate\Validation\Rule;

class AnnouncementRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'ar.title' => 'required|min:10',
            'ar.body' => 'required|min:10',
            'en.title' => 'required|min:10',
            'en.body' => 'required|min:10',
            'from' => 'required|date|after_or_equal:today',
            'to' => 'required|date|after_or_equal:from',
            'branches' => 'required|array|min:1',
            'branches.*' => 'exists:branches,uuid',
            'roles' => 'required|array|min:1',
            'roles.*' => Rule::exists('roles', 'id')->where(function ($query) {
                return $query->whereIn('branch_uuid', request()->get('data')['attributes']['branches']);
            })

        ];
    }

    public function attributes()
    {
        return [
            'ar.title' => trans('announcements.fields.title_ar'),
            'ar.body' => trans('announcements.fields.body_ar'),
            'en.title' => trans('announcements.fields.title_en'),
            'en.body' => trans('announcements.fields.body_en'),
            'from' => trans('announcements.fields.from'),
            'to' => trans('announcements.fields.to')
        ];
    }
}
