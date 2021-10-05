<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Parent\Transformers;

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
        $image = $this->params['device_type'] == 'web' ? $announcement->webImage :
            ($this->params['device_type'] == 'mobile' ? $announcement->mobileImage : null);
        return [
            'id' => $announcement->uuid,
            'title' => $announcement->title,
            'body' => $announcement->body,
            'from' => $announcement->from,
            'to' => $announcement->to,
            'image' => $image ? $image->url :  'https://www.btklsby.go.id/images/placeholder/nogender.png',
        ];
    }
}
