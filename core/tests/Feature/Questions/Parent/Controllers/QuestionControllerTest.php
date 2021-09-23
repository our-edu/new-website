<?php

namespace Tests\Feature\Questions\Parent\Controllers;

use App\CommunicationApp\Questions\Models\Question;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Carbon\Carbon;
use Tests\TestCase;

class  QuestionControllerTest extends TestCase
{

    /**
     * @test
     */
    public function question_list_questionnaire_enabled()
    {
        dump('test_question_list_questionnaire_enabled');
        $this->apiSignIn($this->authParent());
        $generalSetting = GeneralSettings::factory()->create(['value'=>true]);
        $questions = Question::factory(10)->create();
        $response = $this->getJson("/api/v1/en/parent/questions");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'body',
                        'active'
                    ]
                ]
            ],
            'meta' => [
                'default_actions'=>[
                    'create_complain'
                ],
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                ]
            ],

        ]);
    }

    /**
     * @test
     */
    public function question_list_questionnaire_disabled()
    {
        dump('test_question_list_questionnaire_disabled');
        $this->apiSignIn($this->authParent());
        $generalSetting = GeneralSettings::factory()->create();
        $questions = Question::factory(10)->create();
        $response = $this->getJson("/api/v1/en/parent/questions");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'default_actions'=>[
                    'create_complain'
                ]
            ],

        ]);
    }
}

