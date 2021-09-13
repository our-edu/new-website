<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BaseApp\Models\UploadedMedia;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];

    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return (mixed|string)[]
     *
     * @psalm-return array{id: mixed, url: string}
     */
    public function transform(UploadedMedia $attachment): array
    {

        $transformerData = [
            'id' => $attachment->uuid,
            'url' => $attachment->url,
        ];
        return $transformerData;
    }
}
