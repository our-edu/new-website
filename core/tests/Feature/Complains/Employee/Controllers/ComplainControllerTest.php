<?php

namespace Tests\Feature\Complains\Employee\Controllers;

use App\BaseApp\Models\ParentUser;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use App\CommunicationApp\Questions\Models\Question;
use Tests\TestCase;

class  ComplainControllerTest extends TestCase
{

    /**
     * @test
     */
    public function complains_list()
    {
        dump('test_complains_list');
        $this->apiSignIn($this->authEmployee());
        $complains = Complain::factory(10)->create([
            "category" => ComplainCategoriesEnum::CANTEEN_EN,
        ]);
        $response = $this->getJson("/api/v1/en/employee/complains");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        "title",
                         "body",
                        "status",
                        "category",
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
        $this->apiSignIn($this->authEmployee());
        $complain = Complain::factory()->create([
                "category" => ComplainCategoriesEnum::CANTEEN_EN,
        ]);
        $response = $this->getJson("/api/v1/en/employee/complains/".$complain->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [

                    'type',
                    'id',
                    'attributes' => [
                        "title",
                        "body",
                        "status",
                        "category",
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
            ,

        ]);
    }
    /**
     * @test
     */
    public function complains_with_questions_show()
    {
        dump('test_complains_with_questions_show');
        $this->apiSignIn($this->authEmployee());
        $complain = Complain::factory()->create([
            "category" => ComplainCategoriesEnum::CANTEEN_EN,
        ]);
        $questions = Question::factory(3)->create();
        $parent = ParentUser::factory()->create();
        foreach ($questions as $question){
            $complain->questionsAnswers()->create(
                [
                    'value' =>  \Faker\Factory::create()->word,
                    'parent_uuid' => $parent->uuid ,
                    'question_uuid'=> $question->uuid

                ]
            );}

        $response = $this->getJson("/api/v1/en/employee/complains/".$complain->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [

                'type',
                'id',
                'attributes' => [
                    "title",
                    "body",
                    "category",
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
                    ],
                    'questionsAnswers' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ]
                ]
            ]
            ,

        ]);
    }
    /**
     * @test
     */
    public function complains_resolve()
    {
        dump('test_complains_resolve');
        $this->apiSignIn($this->authEmployee());
        $complain = Complain::factory()->create([
            "category" => ComplainCategoriesEnum::CANTEEN_EN,
        ]);
        $data =  [
            "data" => [
                "type" => "complain",
                "id" => "null",
                "attributes" => [
                    "status" => "resolved",
                    "procedure"=>"prodcasdsd"
                ]
            ]

        ];
        $response = $this->putJson("/api/v1/en/employee/complains/".$complain->uuid.'/resolve',$data);
        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    "title",
                    "body",
                    "category",
                    "status",
                    "procedure",
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
    public function complains_with_questions_resolve()
    {
        dump('test_complains_with_questions_resolve');
        $this->apiSignIn($this->authEmployee());
        $complain = Complain::factory()->create([
            "category" => ComplainCategoriesEnum::CANTEEN_EN,
        ]);
        $questions = Question::factory(3)->create();
        $parent = ParentUser::factory()->create();
        foreach ($questions as $question){
            $complain->questionsAnswers()->create(
                [
                    'value' =>  \Faker\Factory::create()->word,
                    'parent_uuid' => $parent->uuid ,
                    'question_uuid'=> $question->uuid

                ]
            );}
        $data =  [
            "data" => [
                "type" => "complain",
                "id" => "null",
                "attributes" => [
                    "status" => "resolved",
                    "procedure"=>"prodcasdsd"

                ]
            ]

        ];
        $response = $this->putJson("/api/v1/en/employee/complains/".$complain->uuid.'/resolve',$data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    "title",
                    "body",
                    "category",
                    "status",
                    "parent",
                    "student"
                ],
                "relationships" => [
                    'questionsAnswers' => [
                        'data' => [
                            [
                                'type',
                                'id'
                            ]
                        ]
                    ]
                ]

            ]
            ,

        ]);
    }

}