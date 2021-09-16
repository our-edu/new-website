<?php

namespace Database\Seeders;

use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Exception;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return string
     */
    public function run()
    {
        try{
            $questionnaire = GeneralSettingsEnum::getQuestionnaireEnums();
            GeneralSettings::create([
                'key'   => $questionnaire['key'],
                'value' => $questionnaire['value']['disable']
            ]);
        }catch (Exception $exception){
            return $exception->getMessage();
        }

    }
}
