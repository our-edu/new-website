<?php

namespace Tests\Feature\Events\Employee\Controllers;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;
use Carbon\Carbon;
use Tests\TestCase;

class  EventsControllerTest extends TestCase
{

    /**
     * @test
     */
    public function event_list()
    {
        dump('test_event_list');
        $this->apiSignIn($this->authEmployee());

        $branchUuid = Branch::all()->count() > 0 ? (Branch::all()->first()->uuid) : Branch::factory()->create()->uuid;
        $event = Event::factory()->create();
        $event->branches()->attach([$branchUuid]);

        $response = $this->getJson("/api/v1/en/employee/events");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                        'body_ar',
                        'body_en',
                        'start',
                        'end',
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
            ]
        ]);
    }

    /**
     * @test
     */
    public function event_list_filter()
    {
        dump('test_event_list_filter');
        $this->apiSignIn($this->authEmployee());


        $response = $this->getJson("/api/v1/en/employee/events/index/filters");
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'filters' => [
                    'period' => [
                        'label',
                        'input_type',
                        'values'
                    ],
                ]
            ],
        ]);
    }

    /**
     * @test
     */
    public function events_show()
    {
        dump('test_events_show');
        $this->apiSignIn($this->authEmployee());
        $event = Event::factory()->create();
        $response = $this->getJson("/api/v1/en/employee/events/".$event->uuid);
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
                    'full_day',
                    'start',
                    'end',
                    'all_branches',
                    'branches',
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
            ]
        ]);
    }

    /**
     * @test
     */
    public function event_store()
    {
        dump('test_event_store');
        $this->apiSignIn($this->authEmployee());

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
                    'full_day' => 0,
                    'start' => Carbon::now()->toDateTimeString(),
                    'end' => Carbon::tomorrow()->toDateTimeString(),
                    'all_branches' => 0,
                    'branches' => [
                        Branch::all()->count() > 0 ? (Branch::all()->first()->uuid) : Branch::factory()->create()->uuid
                    ]

                ],

            ]
        ];
        $response = $this->postJson("/api/v1/en/employee/events", $data);
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
                    'full_day',
                    'start',
                    'end',
                    'all_branches',
                    'branches',
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
    public function event_update()
    {
        dump('test_event_update');
        $this->apiSignIn($this->authEmployee());

        $eventUuid = Event::factory()->create()->uuid;

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
                    'full_day' => 0,
                    'start' => Carbon::now()->toDateTimeString(),
                    'end' => Carbon::tomorrow()->toDateTimeString(),
                    'all_branches' => 0,
                    'branches' => [
                        Branch::all()->count() > 0 ? (Branch::all()->first()->uuid) : Branch::factory()->create()->uuid
                    ]

                ],

            ]
        ];
        $response = $this->putJson("/api/v1/en/employee/events/$eventUuid", $data);
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
                    'full_day',
                    'start',
                    'end',
                    'all_branches',
                    'branches',
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
    public function event_delete()
    {
        dump('test_event_delete');
        $this->apiSignIn($this->authEmployee());

        $response = $this->deleteJson("/api/v1/en/employee/events/".Event::factory()->create()->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'message'
            ]
        ]);
    }
}

