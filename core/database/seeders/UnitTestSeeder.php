<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitTestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // order matter
        $this->call(\Database\Seeders\seeders_test\DummySchoolSeeder::class);
        $this->call(\Database\Seeders\seeders_test\DummyUsersSeeder::class);
        $this->call(\Database\Seeders\seeders_test\Roles\PermissionSeeder::class);
        $this->call(\Database\Seeders\seeders_test\Roles\EmployeeRolesSeeder::class);
        $this->call(\Database\Seeders\seeders_test\Roles\AssignRoleLeaderToEmployee::class);
    }
}
