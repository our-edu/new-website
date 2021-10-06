<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Settings\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Settings\model\GeneralSettings;
use League\Fractal\TransformerAbstract;

class ListSettingsTransformer extends TransformerAbstract
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

    public function transform(GeneralSettings $generalSetting): array
    {
        return [
            'id' => $generalSetting->uuid,
            'key' => $generalSetting->key,
            'value' => $generalSetting->value
        ];
    }

    public function includeActions(GeneralSettings $generalSetting)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.generalSettings.show', [
                'generalSetting' => $generalSetting->uuid,
            ]),
            'label' => trans('enums.APIActionsEnums.'.APIActionsEnums::SHOW_SETTING),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_SETTING
        ];

        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.generalSettings.update', [
                'generalSetting' => $generalSetting->uuid,
            ]),
            'label' => trans('enums.APIActionsEnums.'.APIActionsEnums::UPDATE_SETTING),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_SETTING
        ];

        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
