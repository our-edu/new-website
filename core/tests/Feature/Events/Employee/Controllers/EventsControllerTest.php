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
                        'title_ar',
                        'title_en',
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
}

