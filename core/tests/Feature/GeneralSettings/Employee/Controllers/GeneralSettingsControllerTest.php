<?php

namespace Tests\Feature\GeneralSettings\Employee\Controllers;

use App\BaseApp\Enums\UserTypeEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Carbon\Carbon;
use Tests\TestCase;

class  GeneralSettingsControllerTest extends TestCase
{

    /**
     * @test
     */
    public function general_settings_list()
    {
        dump('test_general_settings_list');
        $this->apiSignIn($this->authEmployee());
        $generalSetting = GeneralSettings::factory()->create();
        $response = $this->getJson("/api/v1/en/employee/generalSettings");
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'key',
                        'value',
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
    public function general_settings_show()
    {
        dump('test_general_settings_show');
        $this->apiSignIn($this->authEmployee());
        $generalSetting = GeneralSettings::factory()->create();
        $response = $this->getJson("/api/v1/en/employee/generalSettings/".$generalSetting->uuid);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'key',
                        'value',
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
                    ],
         ]
        ]);
    }

    /**
     * @test
     */
    public function update_questionnaire_status()
    {
        dump('test_update_questionnaire_status');
        $this->apiSignIn($this->authEmployee());
        $generalSetting  = GeneralSettings::factory()->create();
        $data =  [
            "data" => [
                "type" => "general_settings",
                "id" => "null",
                "attributes" => [
                    "value" => true
                ]
            ]
        ];
        $response = $this->putJson("/api/v1/en/employee/generalSettings/".$generalSetting->uuid."/questionnaireStatus", $data);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'key',
                    'value',
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

        ]);    }

}

