<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Models\SchoolEmployee;
use League\Fractal\TransformerAbstract;

class ApplicationBranchEmployeeTransformer extends TransformerAbstract
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

    public function transform(SchoolEmployee $schoolEmployee)
    {
        $transformerData = [
            'id' => $schoolEmployee->uuid,
            'name' => $schoolEmployee->user->name,
            'email' => $schoolEmployee->user->email ?? '',
            'mobile' => $schoolEmployee->user->mobile,
            'role'=> $schoolEmployee->user->userRole()->count() != 0 ? $schoolEmployee->user->userRole[0]->display_name
                : null,
        ];
        return $transformerData;
    }
}
