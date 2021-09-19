<?php

namespace Tests\Feature\Announcements\Employee\Controllers;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\CommunicationApp\Announcements\Models\Announcement;
use Carbon\Carbon;
use Tests\TestCase;

class  AnnouncementControllerTest extends TestCase
{

    /**
     * @test
     */
    public function announcement_store()
    {
        dump('test_announcement_store');
        $this->apiSignIn($this->authEmployee());

        $branchUuid = Branch::all()->count() > 0 ? (Branch::all()->first()->uuid) : Branch::factory()->create()->uuid;
        $roleName = \Faker\Factory::create()->name().'_'.$branchUuid;
        $roleUuid = Role::where('branch_uuid', $branchUuid)->count() > 0 ? (Role::where('branch_uuid', $branchUuid)->first()->id) : Role::create([
            'name' => $roleName,
            'display_name:ar' => \Faker\Factory::create()->name(),
            'display_name:en' => \Faker\Factory::create()->name(),
            'user_type'=> UserTypeEnum::EMPLOYEE,
            'slug'=> $roleName,
            'guard_name' => 'api',
            'branch_uuid' => $branchUuid,
        ])->id;
        $data = [
            "data" => [
                'id' => "null",
                'type' => "application",
                'attributes' => [
                    'ar' => [
                        'title' => "test announcements",
                        'body' => 'test announcements'
                    ],
                    "en" => [
                        'title' => "test announcements",
                        'body' => 'test announcements'
                    ],
                    'from' => Carbon::now()->toDateString(),
                    'to' => Carbon::tomorrow()->toDateString(),
                    'branches' => [
                        $branchUuid
                    ],
                    'roles' => [
                        $roleUuid
                    ]

                ],

            ]
        ];
        $response = $this->postJson("/api/v1/en/employee/announcements", $data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'title_ar',
                    'title_en',
                    'body_ar',
                    'body_en',
                    'from',
                    'to',
                    'branches',
                    'roles',
                ],
                "relationships" => [
                    'actions' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ]
                ]
            ],
            'meta' => [
                'message'
            ]
        ]);
    }

    /**
     * @test
     */
    public function announcement_delete()
    {
        dump('test_announcement_delete');
        $this->apiSignIn($this->authEmployee());

        $response = $this->deleteJson("/api/v1/en/employee/announcements/".Announcement::factory()->create()->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'message'
            ]
        ]);
    }
}

