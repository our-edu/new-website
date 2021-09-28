<?php

namespace Tests\Feature\Complains\Parent\Controllers;

use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\Student;
use App\CommunicationApp\Complains\Models\Complain;
use App\CommunicationApp\Questions\Models\Question;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Tests\TestCase;

class  ComplainControllerTest extends TestCase
{

    /**
     * @test
     */
    public function complains_list()
    {
        dump('test_complains_list');
        $this->apiSignIn($this->authParent());
        $complains = Complain::factory(10)->create([
            'parent_uuid' => $this->authParent()->parent->uuid
        ]);
        $response = $this->getJson("/api/v1/en/parent/complains");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        "title",
                        "status",
                        "parent",
                        "student"
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
    public function complains_show()
    {
        dump('test_complains_show');
        $this->apiSignIn($this->authParent());
        $complain= Complain::factory()->create([
            'parent_uuid' => $this->authParent()->parent->uuid
        ]);
        $response = $this->getJson("/api/v1/en/parent/complains/".$complain->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [

                    'type',
                    'id',
                    'attributes' => [
                        "title",
                        "body",
                        "status",
                        "parent",
                        "student"
                    ],

                ]
            ,

        ]);
    }
    /**
     * @test
     */
    public function complains_store_with_questionnaire_disabled()
    {
        dump('test_complains_store_with_questionnaire_disabled');
        $this->apiSignIn($this->authParent());
        $student = Student::first();
        $generalSetting = GeneralSettings::factory()->create();
        $data =  [
            "data" => [
                "type" => "complain",
                "id" => "null",
                "attributes" => [
                    "body" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "title" => "Safety test",
                    "student_uuid" => $student->uuid
                ]
            ]
        ];
        $data2=  [
            "data" => [
                "type" => "complain",
                "id" => "null",
                "attributes" => [
                    "body" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "title" => "Safety test",
                    "student_uuid" => "0e2729e3-367d-4f64-a6f5-bd1ec9ad8b69",
                    "questions_answers" => [
                        [
                            "question_uuid" => "0e2729e3-367d-4f64-a6f5-bd1ec9ad8b69",
                            "answer" => "test answer"
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->postJson("/api/v1/en/parent/complains/",$data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    "title",
                    "body",
                    "status",
                    "parent",
                    "student"
                ],

            ]
            ,

        ]);
    }
    /**
     * @test
     */
    public function complains_store_with_questionnaire_enabled()
    {
        dump('test_complains_store_with_questionnaire_enabled');
        $this->apiSignIn($this->authParent());
        $student = Student::first();
        $generalSetting = GeneralSettings::factory()->create(['value'=>true]);
        $question = Question::factory()->create();
        $data=  [
            "data" => [
                "type" => "complain",
                "id" => "null",
                "attributes" => [
                    "body" => "test bodytest bodytest bodytest bodytest bodytest body",
                    "title" => "Safety test",
                    "student_uuid" => $student->uuid,
                    "questions_answers" => [
                        [
                            "question_uuid" => $question->uuid,
                            "answer" => "test answer"
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->postJson("/api/v1/en/parent/complains/",$data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    "title",
                    "body",
                    "status",
                    "parent",
                    "student"
                ],

            ]
            ,

        ]);
    }

}