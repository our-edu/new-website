<?php

namespace Database\Seeders\seeders_test\Roles;

use App\BaseApp\Models\Role;
use App\BaseApp\Models\User;
use Illuminate\Database\Seeder;

class AssignRoleLeaderToEmployee extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::with('schoolEmployee')->where('type', 'employee')->first();
        $role = Role::where('branch_uuid', $user->schoolEmployee->branch_id)->first();
        $user->assignRole($role);
    }
}
