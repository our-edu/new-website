<?php

namespace Database\Seeders\seeders_test;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Faker\Factory;

class DummyUsersSeeder extends Seeder
{
    private $parentId = '';

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        dump('Running Users Seeder');

        $types = [
            'parent',   //   dont need them for now
            'student',
//            'admin',
            'employee'
        ];

        foreach ($types as $userType) {
            $userId = Uuid::uuid4()->toString();
            DB::table('users')->insert([
                'uuid' => $userId,
                'first_name' => $userType,
                'last_name' => 'user',
                'email' => "$userType@$userType.com",
                "status" => 'active',
                "profile_picture" => 'img/person',
                "type" => $userType,
                "password" => 'kpbjg564fdbdf684-654fd',
                "national_id" => Uuid::uuid4()->toString()
            ]);

            switch ($userType) {
                case 'parent':
                    $this->createParentData($userId);
                    break;
                case 'student':
                    $this->createStudentData($userId);
                    break;
                case 'employee':
                    $this->createEmployeeData($userId);
                    break;
                default:
            }
        }
    }

    private function createEmployeeData($userId)
    {
        DB::table('school_employees')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'user_id' => $userId,
            'branch_id' => DB::table('branches')->first()->uuid,
        ]);
    }

    private function createParentData($userId)
    {
        $this->parentId = Uuid::uuid4()->toString();
        DB::table('parent_users')->insert([
            'uuid' => $this->parentId,
            'user_uuid' => $userId,
        ]);
    }
    private function createStudentData($userId)
    {
        $branch = DB::table('branches')->first();
        $school = DB::table('schools')->first();

        // student data
        $studentId = Uuid::uuid4()->toString();
        DB::table('students')->insert([
            'uuid' => $studentId,
            'user_id' => $userId,
            'branch_id' => $branch->uuid,
            'pocket_money' => 555,
            'notes' => '',
            'attachments' => '',
            'birth_date' => ' 2015-01-12 12:45:00-06',
        ]);

        // relation with the parent
        DB::table('parent_student')->insert([
            'student_uuid' => $studentId,
            'parent_uuid' => $this->parentId
        ]);

        // add the parent to the school
        $parent = DB::table('parent_users')->where('uuid', $this->parentId)->first();

        // if parent is already added to this school == parent has student in this school
        $parentAddedToThisSchool = DB::table('school_users')
            ->where('school_id', $school->uuid)
            ->where('user_id', $parent->user_uuid)
            ->exists();

        if (!$parentAddedToThisSchool) {
            DB::table('school_users')->insert([
                'school_id' => $school->uuid,
                'user_id' => $parent->user_uuid
            ]);
        }


        // student additional data (cart)
        DB::table('carts')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'user_id' => $userId,

        ]);

        // student additional data (parent config)
        DB::table('student_general_config')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'student_uuid' => $studentId,
            'money_amount_per_day' => 100,
            'calories_amount_per_day' => 100
        ]);
    }
}
