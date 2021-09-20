<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Parent\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class ListQuestionsTransformer extends TransformerAbstract
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

    public function transform(Question $question): array
    {
        return [
            'id' => $question->uuid,
            'body' => $question->body,
            'active' => $question->active
        ];
    }
}
