<?php

namespace Tests\Feature\CommunicationLogs\Visits\Employee\Controllers;

use App\BaseApp\Models\ParentUser;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use Carbon\Carbon;
use Tests\TestCase;

class  VisitsControllerTest extends TestCase
{

    /**
     * @test
     */
    public function visits_list()
    {
        dump('test_visits_list');
        $this->apiSignIn($this->authEmployee());
        $visits = CommunicationLog::factory(10)->create([
            'type' => CommunicationLogTypesEnums::VISITS,
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $response = $this->getJson("/api/v1/en/employee/visits");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'reason',
                        'date',
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
    public function visits_show()
    {
        dump('test_visits_show');
        $this->apiSignIn($this->authEmployee());
        $visit = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::VISITS,
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $response = $this->getJson("/api/v1/en/employee/visits/" . $visit->uuid);
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
    public function visits_store()
    {
        dump('test_visits_store');
        $this->apiSignIn($this->authEmployee());
        $visit = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::VISITS,
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $data = [
            "data" => [
                "type" => "visit",
                "id" => "null",
                "attributes" => [
                    "reason" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "parent_national_id" => ParentUser::factory()->create()->user->national_id,
                    "date" => "2021-12-22",
                    "procedure" => "dsasd"
                ]
            ]
        ];


        $response = $this->postJson("/api/v1/en/employee/visits/", $data);
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
    public function visits_update()
    {
        dump('test_visits_update');
        $this->apiSignIn($this->authEmployee());
        $visit = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::VISITS,
            'branch_uuid' => $this->authEmployee()->schoolEmployee->branch_id
        ]);
        $data = [
            "data" => [
                "type" => "visit",
                "id" => "null",
                "attributes" => [
                    "reason" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "parent_national_id" => ParentUser::factory()->create()->user->national_id,
                    "date" => "2021-12-22",
                    "procedure" => "dsadasas"

                ]
            ]
        ];


        $response = $this->putJson("/api/v1/en/employee/visits/" . $visit->uuid, $data);
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
    public function visits_delete()
    {
        dump('test_visits_delete');
        $this->apiSignIn($this->authEmployee());
        $visit = CommunicationLog::factory()->create([
            'type' => CommunicationLogTypesEnums::VISITS,
            'branch_uuid'=>$this->authEmployee()->schoolEmployee->branch_id
        ]);

        $response = $this->deleteJson("/api/v1/en/employee/visits/".$visit->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'message'
            ],
        ]);
    }
}