<?php

namespace Tests\Feature\Questions\Employee\Controllers;

use App\CommunicationApp\Questions\Models\Question;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Tests\TestCase;

class  QuestionControllerTest extends TestCase
{

    /**
     * @test
     */
    public function question_list()
    {
        dump('test_question_list');
        $this->apiSignIn($this->authEmployee());
        $generalSetting = GeneralSettings::factory()->create();
        $questions = Question::factory(5)->create();
        $response = $this->getJson("/api/v1/en/employee/questions");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'body_en',
                        'body_ar',
                        'active'
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
                'default_actions'=>[
                       'update_questionnaire_status'
                ],
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
    public function question_show()
    {
        dump('test_question_show');
        $this->apiSignIn($this->authEmployee());
        $question= Question::factory()->create();
        $response = $this->getJson("/api/v1/en/employee/questions/".$question->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' =>
                [
                    'type',
                    'id',
                    'attributes' => [
                        'body_en',
                        'body_ar',
                        'active'
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
    public function question_store()
    {
        dump('test_question_store');
        $this->apiSignIn($this->authEmployee());
        $data =  [
            "data" => [
                "type" => "page",
                "id" => "null",
                "attributes" => [
                    "ar" => [
                        "body" => "question Body arabic"
                    ],
                    "en" => [
                        "body" => "question Body english"
                    ],
                    "active" => false
                ]
            ]
        ];
        $response = $this->postJson("/api/v1/en/employee/questions/",$data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' =>
                [
                    'type',
                    'id',
                    'attributes' => [
                        'body_en',
                        'body_ar',
                        'active'
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
            'meta' => [
                'message'
            ]

        ]);
    }

    /**
     * @test
     */
    public function question_update()
    {
        dump('test_question_update');
        $this->apiSignIn($this->authEmployee());
        $question = Question::factory()->create();
        $data =  [
            "data" => [
                "type" => "question",
                "id" => "null",
                "attributes" => [
                    "ar" => [
                        "body" => "question Body arabic updated"
                    ],
                    "en" => [
                        "body" => "question Body english updated"
                    ],
                    "active" => true
                ]
            ]
        ];
        $response = $this->putJson("/api/v1/en/employee/questions/".$question->uuid,$data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' =>
                [
                    'type',
                    'id',
                    'attributes' => [
                        'body_en',
                        'body_ar',
                        'active'
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
            'meta' => [
                'message'
            ]

        ]);
    }
    /**
     * @test
     */
    public function question_delete()
    {
        dump('test_question_delete');
        $this->apiSignIn($this->authEmployee());
        $question = Question::factory()->create();
        $response = $this->deleteJson("/api/v1/en/employee/questions/".$question->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'meta' => [
                'message'
            ]

        ]);
    }
}

