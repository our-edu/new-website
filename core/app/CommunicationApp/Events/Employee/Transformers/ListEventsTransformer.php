<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Announcements\Models\Announcement;
use League\Fractal\TransformerAbstract;

class ListEventsTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'actions',
        'branches',
        'roles',
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

    public function transform(Announcement $announcement): array
    {
        return [
            'id' => $announcement->uuid,
            'title_ar' => $announcement->translate('ar')->title,
            'title_en' => $announcement->translate('en')->title,
            'body_ar' => $announcement->translate('ar')->body,
            'body_en' => $announcement->translate('en')->body,
            'from' => $announcement->from,
            'to' => $announcement->to,
            'created_at' => $announcement->created_at,
            'publisher' => $announcement->publisher->name,
            'status' => $announcement->getPublishStatus(),
        ];
    }

    public function includeActions(Announcement $announcement)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.update', [
                'announcement' => $announcement->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::UPDATE_ANNOUNCEMENT),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_ANNOUNCEMENT
        ];

        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.show', [
                'announcement' => $announcement->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::SHOW_ANNOUNCEMENT),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_ANNOUNCEMENT
        ];

        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.announcements.destroy', [
                'announcement' => $announcement->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::DELETE_ANNOUNCEMENT),
            'method' => 'DELETE',
            'key' => APIActionsEnums::DELETE_ANNOUNCEMENT
        ];



        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }

    public function includeBranches(Announcement $announcement)
    {
        if (count($announcement->branches)) {
            return $this->collection(
                $announcement->branches,
                new EventBranchesTransformer(),
                ResourceTypesEnums::BRANCH
            );
        }
    }
}
