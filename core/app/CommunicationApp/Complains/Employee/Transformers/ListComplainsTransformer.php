<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ListComplainsTransformer extends TransformerAbstract
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

    public function transform(Complain $complain): array
    {
        return [
            'id' => $complain->uuid,
            'title' => $complain->title,
            'body' => $complain->body,
            'category' => ComplainCategoriesEnum::getCategoriesTranslated()[$complain->category][app()->getLocale()],
            'status' => ComplainStatusesEnum::getStatuses()[$complain->status][app()->getLocale()],
            'parent' => $complain->parent->user->name,
            'student' => $complain->student->user->name,
            'rejection_reason' =>  $complain->statuses()->where('name',ComplainStatusesEnum::REJECTED_EN)->latest()->first() ?
                $complain->statuses()->where('name',ComplainStatusesEnum::REJECTED_EN)->latest()->first()->reason:
                null,
            'creation_date' => $complain->created_at,
            'resolve_date' => $complain->statuses()->where('name',ComplainStatusesEnum::RESOLVED_EN)->latest()->first()  ? $complain->statuses()->where('name',ComplainStatusesEnum::RESOLVED_EN)->latest()->first()->created_at  : null
        ];
    }

    public function includeActions(Complain $complain)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.complains.show', [
                'complain' => $complain->uuid,
            ]),
            'label' => trans('enums.'.APIActionsEnums::SHOW_COMPLAIN),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_COMPLAIN
        ];


        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
