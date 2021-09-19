<?php
namespace Database\Seeders\seeders_test\Roles;

use App\BaseApp\Enums\CrudOperationsEnums;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Permission;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeePrefix = 'emp';
        $adminPrefix = 'admin';
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $employeeCrudModules = [
            'classrooms',
            'student',
            'teachers',
            'buses',
            'drivers',
            'busRoutes',
            'breakTimes',
            'canteen',
        ];
        $adminCrudModules = [
            'academicYears',
            'categories',
            'countries',
            'educationalSystems',
            'grades',
            'printers',
            'semesters',
            'subjects',
        ];
        $crudeOperations = CrudOperationsEnums::getCrudOperations();
        foreach ($employeeCrudModules as $module) {
            foreach ($crudeOperations as $operation) {
                $employeeCrudPermissions [] = $operation . '__' . $module;
            }
        }
        foreach ($adminCrudModules as $module) {
            foreach ($crudeOperations as $operation) {
                $adminCrudPermissions [] = $operation . '__' . $module;
            }
        }

        $employeeSpecialPermissions = [
            'list_classroom_subjects__classrooms',
            'assign_subjects__classrooms',
            'unassign_subjects__classrooms',
            'show_classroom_subjects__classrooms',
            'view__grades',
            'update__grades',
            'index__parents',
            'show__parents',
            'index_children__parents',
            'download__student',
            'import__student',
            'index_by_classroom__student',
            'unassign_student__student',
            'index__subjects',
            'view__subjects',
            'assign_teacher__subjects',
            'index_teachers__subjects',
            'index_subjects__teachers',
            'import__teachers',
            'index__applications',
            'view__applications',
            'change_status_to_pending_for_interview__applications',
            'change_status_to_pending_for_hard_copies__applications',
            'change_status_to_pending_for_payment__applications',
            'change_status_to_returned__applications',
            'index__interviewAppointment',
            'create_schedule__interviewAppointment',
            'update_schedule__interviewAppointment',
            'assign_student__buses',
            'unassign_student__buses',
            'index_students__buses',
            'assign_routes__buses',
            'index_student__buses',
            'index_to_assign_to_bus__student',
            'unassign_student_from_bus__student',
            'add_student_bus_point__student',
            'index__categories',
            'index__products',
            'create_canteen_supervisor__users',
            'create_canteen_seller__users',
            'index_calls__automaticCall'
        ];
        $adminSpecialPermissions = [
            'index__apps',
            'index__SchoolEmployees',
            'index__Schools',
            'show__Schools',
            'update__Schools',
            'delete__Schools',
            'create-school__Schools',
            'store__Branches',
            'show__Branches',
            'update__Branches',
            'delete__Branches',
            'assign-semesters__Branches',
            'list-gender__Branches',
            'list-grade__Branches',
            'list-semesters__Branches',
        ];
        $allEmployeePermissions = array_merge($employeeCrudPermissions, $employeeSpecialPermissions);
        $allEmployeePermissions = array_map(function ($permission) use ($employeePrefix) {
            $module = explode('__', $permission);
            return [
                'id' => Uuid::uuid4()->toString(),
                'name' => $employeePrefix . "_" . $permission,
                'module' => $module[1],
                'user_type' => UserTypeEnum::EMPLOYEE,
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ];
        }, $allEmployeePermissions);

        $allAdminPermissions = array_merge($adminCrudPermissions, $adminSpecialPermissions);
        $allAdminPermissions = array_map(function ($permission) use ($adminPrefix) {
            $module = explode('__', $permission);
            return [
                'id' => Uuid::uuid4()->toString(),
                'name' => $adminPrefix . "_" . $permission,
                'module' => $module[1],
                'user_type' => UserTypeEnum::ADMIN,
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ];
        }, $allAdminPermissions);
        Permission::insert($allEmployeePermissions);
        Permission::insert($allAdminPermissions);
    }
}
