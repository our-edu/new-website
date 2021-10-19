<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class ViewAnnouncementsTransformer extends TransformerAbstract
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

    public function transform(Announcement $announcement): array
    {
        return [
            'id' => $announcement->uuid,
            'title' => $announcement->title,
            'body' => $announcement->body,
            'from' => $announcement->from,
            'to' => $announcement->to,
            'image' => $announcement->webImage ? $announcement->webImage->url :  'https://www.btklsby.go.id/images/placeholder/nogender.png',
        ];
    }
}
