<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class AnnouncementTransformer extends TransformerAbstract
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
            'branches' => $announcement->branches->pluck('uuid'),
            'roles' => $announcement->roles->pluck('id')
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
}
