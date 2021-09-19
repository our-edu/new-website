<?php

namespace Database\Seeders\seeders_test\Roles;

use App\BaseApp\Enums\RoleEnum;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use Illuminate\Database\Seeder;

class EmployeeRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeRoles =  RoleEnum::getRoles();
        $branches = Branch::all();

        foreach ($branches as $branch) {
            foreach ($employeeRoles as $key => $role) {
                Role::create([
                    'name' => $key.'_'.$branch->uuid,
                    'display_name:ar' => $role['display_ar'],
                    'display_name:en' => $role['display_en'],
                    'user_type'=> UserTypeEnum::EMPLOYEE,
                    'slug'=> $key.'_'.$branch->uuid,
                    'guard_name' => 'api',
                    'branch_uuid' => $branch->uuid,
                ]);
            }
        }
    }
}
