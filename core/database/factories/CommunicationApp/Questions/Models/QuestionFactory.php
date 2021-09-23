<?php


namespace Database\Factories\CommunicationApp\Questions\Models;

use App\CommunicationApp\Questions\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'active' => false,
            'body:ar' => $this->faker->word(),
            'body:en' => $this->faker->word(),
        ];
    }
}
