<?php

namespace Database\Factories\AutomaticPaymentApp\Models;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Psalm\LaravelPlugin\Models\Car;

class ParentDueBalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParentDueBalance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'parent_name' => $this->faker->name,
            'national_id' => $this->faker->uuid,
            'balance' => $this->faker->randomFloat(),
            'email'=> $this->faker->email,
            'created_at' => Carbon::now()
        ];
    }
}
