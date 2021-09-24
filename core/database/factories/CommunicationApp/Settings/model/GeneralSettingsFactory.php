<?php


namespace Database\Factories\CommunicationApp\Settings\model;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeneralSettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GeneralSettings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => GeneralSettingsEnum::QUESTIONNAIRE_STATUS_KEY,
            'value' => GeneralSettingsEnum::QUESTIONNAIRE_DISABLE
        ];
    }
}
