<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class AnnouncementRolesTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
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

    public function transform(Role $role): array
    {
        return [
            'id' => $role->id,
            'display_name_ar' => $role->translate('ar')->display_name,
            'display_name_en' => $role->translate('en')->display_name,
        ];
    }
}
