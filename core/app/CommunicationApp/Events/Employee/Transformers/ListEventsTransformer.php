<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;
use League\Fractal\TransformerAbstract;

class ListEventsTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'actions',
    ];
    protected $availableIncludes = [
    ];

    /**
     * @var array|mixed
     */
    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function transform(Event $event): array
    {
        return [
            'id' => $event->uuid,
            'title' => $event->title,
            'body_ar' => $event->translate('ar')->body,
            'body_en' => $event->translate('en')->body,
            'start' => $event->start,
            'end' => $event->end,
        ];
    }

    public function includeActions(Event $event)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.events.update', [
                'event' => $event->uuid,
            ]),
            'label' => trans('enums.APIActionsEnums.'.APIActionsEnums::UPDATE_EVENT),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_EVENT
        ];

        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.events.destroy', [
                'event' => $event->uuid,
            ]),
            'label' => trans('enums.APIActionsEnums.'.APIActionsEnums::DELETE_EVENT),
            'method' => 'DELETE',
            'key' => APIActionsEnums::DELETE_EVENT
        ];

        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.events.show', [
                'event' => $event->uuid,
            ]),
            'label' => trans('enums.APIActionsEnums.'.APIActionsEnums::SHOW_EVENT),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_EVENT
        ];



        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
