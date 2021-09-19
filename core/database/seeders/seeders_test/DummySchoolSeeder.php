<?php

namespace Database\Seeders\seeders_test;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DummySchoolSeeder extends Seeder
{
    public $dumpedData = [];

    /**
     *
     */
    public function run()
    {
        dump('Running School Seeder');

        $schoolId = "0294485c-ac23-4e16-bd60-549e63c5a275";
        DB::table('schools')->insert([
            'uuid' => $schoolId,
            'logo' => '',
            'email' => "ibnkhaldun@ibnkhaldun-ouredu.com",
            'apps_names' => json_encode(['canteen', 'dashboard', 'printer']),
        ]);

        DB::table('school_translations')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Ib Khaldun',
            'locale' => 'en',
            'school_uuid' => $schoolId,
        ]);

        DB::table('school_translations')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'ابن خلدون',
            'locale' => 'ar',
            'school_uuid' => $schoolId,
        ]);

        // create branches
        $branchTranslations = [
            'branch_1' => [
                'ar' => 'الياسمين',
                'en' => 'El Yasmin',
            ],
            // not used
            'branch_2' => [
                'ar' => 'القصيم',
                'en' => 'El Qassim',
            ],
        ];
        for ($i = 1; $i < 2; $i++) {
            $branchId = Uuid::uuid4()->toString();
            $en_uuid = Uuid::uuid4()->toString();
            $ar_uuid = Uuid::uuid4()->toString();

            DB::table('branches')->insert([
                'uuid' => $branchId,
                'school_uuid' => $schoolId,
            ]);

            $branch = $branchTranslations["branch_$i"];
            DB::table('branch_translations')->insert([
                'uuid' => $en_uuid,
                'name' => $branch['en'],
                'locale' => 'en',
                'branch_uuid' => $branchId,
            ]);
            DB::table('branch_translations')->insert([
                'uuid' => $ar_uuid,
                'name' => $branch['ar'],
                'locale' => 'ar',
                'branch_uuid' => $branchId,
            ]);

            $this->appendAllAppsToBranch($branchId);
            $this->appendAllAcademicYearsToBranch($branchId);
            $this->appendGradsToBranch($branchId);
            $this->appendEducationalSystemsToBranch($branchId);
            $this->appendSemestersToBranch($branchId);
        }
    }


    private function appendAllAppsToBranch($branchId)
    {
        $apps = DB::table('apps')->get();
        foreach ($apps as $app) {
            DB::table('branch_apps')->insert([
                'branch_id' => $branchId,
                'app_id' => $app->uuid,
            ]);
        }
    }

    private function appendAllAcademicYearsToBranch($branchId)
    {
        $academicYears = DB::table('academic_years')->get()->take(2);
        foreach ($academicYears as $academicYear) {
            DB::table('branch_academic_years')->insert([
                'branch_id' => $branchId,
                'academic_year_id' => $academicYear->uuid,
            ]);
        }
    }

    private function appendGradsToBranch($branchId)
    {
        $grades = DB::table('grades')->get()->take(2);
        foreach ($grades as $grade) {
            DB::table('branch_grades')->insert([
                'branch_id' => $branchId,
                'grade_id' => $grade->uuid,
            ]);
        }
    }

    private function appendSemestersToBranch($branchId)
    {
        $semesters = DB::table('semesters')->get()->take(2);
        foreach ($semesters as $semester) {
            DB::table('branch_semesters')->insert([
                'branch_id' => $branchId,
                'semester_id' => $semester->uuid,
            ]);
        }
    }

    private function appendEducationalSystemsToBranch($branchId)
    {
        $educationalSystems = DB::table('educational_systems')->get()->take(2);
        foreach ($educationalSystems as $educationalSystem) {
            DB::table('branch_educational_systems')->insert([
                'branch_id' => $branchId,
                'educational_system_id' => $educationalSystem->uuid,
            ]);
        }
    }
}
