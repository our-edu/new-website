<?php

namespace Tests\Feature\CommunicationLogs\Calls\Employee\Controllers;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\Role;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use Carbon\Carbon;
use Tests\TestCase;

class  CallsControllerTest extends TestCase
{

    /**
     * @test
     */
    public function calls_list()
    {
        dump('test_calls_list');
        $this->apiSignIn($this->authEmployee());
        $calls = CommunicationLog::factory(10)->create([
            'type' => CommunicationLogTypesEnums::CALLS,
            "procedure" => "test bodytest bodytest bodytest bodytest bodytest body",
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $response = $this->getJson("/api/v1/en/employee/calls");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'reason',
                        'date',
                        'procedure',
                        'branch',
                    ],
                    "relationships" => [
                        'actions' => [
                            'data' => [
                                [
                                    'type',
                                    'id'
                                ]
                            ]
                        ],

                    ]
                ]
            ],
            'meta' => [
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                ]
            ],
            'links' => [
                'self',
                'first',
                'last',
            ]
        ]);
    }

    /**
     * @test
     */
    public function calls_show()
    {
        dump('test_calls_show');
        $this->apiSignIn($this->authEmployee());
        $call = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::CALLS,
            "procedure" => "test bodytest bodytest bodytest bodytest bodytest body",
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $response = $this->getJson("/api/v1/en/employee/calls/" . $call->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'reason',
                    'date',
                    'procedure',
                    'branch',
                ],
                "relationships" => [
                    'actions' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ],

                ]

            ],
        ]);
    }

    /**
     * @test
     */
    public function calls_store()
    {
        dump('test_calls_store');
        $this->apiSignIn($this->authEmployee());
        $call = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::CALLS,
            "procedure" => "test bodytest bodytest bodytest bodytest bodytest body",
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $data = [
            "data" => [
                "type" => "call",
                "id" => "null",
                "attributes" => [
                    "reason" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "parent_national_id" => ParentUser::factory()->create()->user->national_id,
                    "date" => "2021-12-22",
                    "procedure" => "test bodytest bodytest bodytest bodytest bodytest body"
                ]
            ]
        ];


        $response = $this->postJson("/api/v1/en/employee/calls/", $data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'reason',
                    'date',
                    'procedure',
                    'branch',
                ],
                "relationships" => [
                    'actions' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ],

                ]

            ],
        ]);
    }

    /**
     * @test
     */
    public function calls_update()
    {
        dump('test_calls_update');
        $this->apiSignIn($this->authEmployee());
        $call = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::CALLS,
            "procedure" => "test bodytest bodytest bodytest bodytest bodytest body",
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $data = [
            "data" => [
                "type" => "call",
                "id" => "null",
                "attributes" => [
                    "reason" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "parent_national_id" => ParentUser::factory()->create()->user->national_id,
                    "date" => "2021-12-22",
                    "procedure" => "test bodytest bodytest bodytest bodytest bodytest body"
                ]
            ]
        ];


        $response = $this->putJson("/api/v1/en/employee/calls/" . $call->uuid, $data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'reason',
                    'date',
                    'procedure',
                    'branch',
                ],
                "relationships" => [
                    'actions' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ],

                ]

            ],
        ]);
    }
    /**
     * @test
     */
    public function calls_delete()
    {
        dump('test_calls_delete');
        $this->apiSignIn($this->authEmployee());
        $call = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::CALLS,
            "procedure" =>"test bodytest bodytest bodytest bodytest bodytest body",
            'branch_uuid'=>$this->authEmployee()->schoolEmployee->branch_id
        ]);

        $response = $this->deleteJson("/api/v1/en/employee/calls/".$call->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'message'
            ],
        ]);
    }
}