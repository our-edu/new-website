<?php

namespace Database\Factories\BaseApp\Models;

use App\BaseApp\Models\UploadedMedia;
use App\BaseApp\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        dump('Running User Factory');
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            "email" => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
            'password' => $this->faker->password(8),
            'type' => "parent",
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'profile_picture'=> null,
            'national_id'=>$this->faker->randomNumber(2)
        ];
    }
}
