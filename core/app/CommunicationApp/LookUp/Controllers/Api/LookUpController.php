<?php

declare(strict_types = 1);

namespace App\CommunicationApp\LookUp\Controllers\Api;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Models\Role;
use App\CommunicationApp\LookUp\Transformers\EmployeeBranchesRolesLookUpTransformer;

class LookUpController extends BaseApiController
{

//    public function getIndex(Request $request)
//    {
//        $data = ['dum'=>'data'];
//
//        $include = $request->get('include') ?? '';
//
//        $param = $request->get('filter') ?? [];
//
//        return $this->transformDataModInclude(
//            $data,
//            $include,
//            new LookUpTransformer($param),
//            ResourceTypesEnums::LOOKUP
//        );
//    }

    public function getEmployeeBranchesRoles()
    {
        $roles = Role::whereIn('branch_uuid', auth('api')->user()->schoolEmployee->branches->pluck('uuid')->toArray())->get();
        return $this->transformDataModInclude(
            $roles,
            '',
            new EmployeeBranchesRolesLookUpTransformer(),
            ResourceTypesEnums::ROLE
        );
    }
}
