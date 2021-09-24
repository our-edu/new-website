<?php

namespace Database\Factories\BaseApp\Models;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Student;
use App\BaseApp\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $user = User::factory()->create(['type'=>UserTypeEnum::STUDENT])->first();
        return [
           'user_id' => $user->uuid,
        ];
    }
}
