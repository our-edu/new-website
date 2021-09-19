<?php


namespace Database\Factories\CommunicationApp\Announcements\Models;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use App\CommunicationApp\Announcements\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::where('type', UserTypeEnum::EMPLOYEE)->first() ?? User::factory()->create();
        return [
            'from' => Carbon::now(),
            'to' => Carbon::tomorrow(),
            'publisher_uuid' => $user->uuid,
            'status' => 1,
            'title:ar' => $this->faker->word(),
            'title:en' => $this->faker->word(),
            'body:ar' => $this->faker->word(),
            'body:en' => $this->faker->word(),
        ];
    }
}
