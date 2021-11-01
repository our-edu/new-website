<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use League\Fractal\TransformerAbstract;
use Ramsey\Uuid\Uuid;

class ComplainCategoryTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
       // 'actions',
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

    public function transform($category): array
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'name' => ComplainCategoriesEnum::getCategoriesTranslated()[$category][app()->getLocale()],
            'slug'=> $category
        ];
    }
}
