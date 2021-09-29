<?php


namespace Database\Factories\CommunicationApp\Complains\Models;

use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\Student;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_uuid'=> ParentUser::factory()->create()->uuid,
            'student_uuid' => Student::get()->first()->uuid,
            'status' => ComplainStatusesEnum::OPENED_EN,
            'title' => $this->faker->word(),
            'body' => $this->faker->word(),
        ];
    }
}
