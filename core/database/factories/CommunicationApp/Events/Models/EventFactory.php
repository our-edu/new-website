<?php


namespace Database\Factories\CommunicationApp\Events\Models;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::where('type', UserTypeEnum::EMPLOYEE)->first() ?? User::factory()->create();
        return [
            'start' => Carbon::now(),
            'end' => Carbon::tomorrow(),
            'creator_uuid' => $user->uuid,
            'full_day' => 0,
            'all_branches' => 0,
            'status' => 1,
            'title:ar' => $this->faker->word(),
            'title:en' => $this->faker->word(),
            'body:ar' => $this->faker->word(),
            'body:en' => $this->faker->word(),
        ];
    }
}
