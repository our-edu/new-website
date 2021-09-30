<?php

declare(strict_types = 1);

namespace App\CommunicationApp\LookUp\Transformers;

use App\BaseApp\Models\Role;
use League\Fractal\TransformerAbstract;

class EmployeeBranchesRolesLookUpTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [
    ];

    private $param;

    public function __construct(array $param = [])
    {
        $this->param = $param;
    }

    /**
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'id' => $role->id,
            'name' => $role->display_name,
            'branch_name' => $role->branch->name,
        ];
    }
}
