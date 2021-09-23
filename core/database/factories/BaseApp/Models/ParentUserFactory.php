<?php

namespace Database\Factories\BaseApp\Models;

use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParentUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $user = User::factory()->create(['type'=>'parent'])->first();
        return [
            "user_uuid" => $user->uuid,
            "location_point" => "15.00000,29.000000"
        ];
    }
}
