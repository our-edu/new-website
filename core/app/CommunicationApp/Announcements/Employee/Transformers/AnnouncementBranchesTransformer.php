<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BaseApp\Models\Branch;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class AnnouncementBranchesTransformer extends TransformerAbstract
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

    public function transform(Branch $branch): array
    {
        return [
            'id' => $branch->uuid,
            'name_ar' => $branch->translate('ar')->name,
            'name_en' => $branch->translate('en')->name,
        ];
    }
}
