<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BoilerplateApp\Applications\Models\ApplicationAttachment;
use League\Fractal\TransformerAbstract;

class ListAttachmentTransformer extends TransformerAbstract
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

    public function transform(ApplicationAttachment $application_attachment): array
    {
        $transformerData = [
            'id' => $application_attachment->uploadedFile->uuid,
            'url' => $application_attachment->uploadedFile->url,
        ];
        return $transformerData;
    }
}
