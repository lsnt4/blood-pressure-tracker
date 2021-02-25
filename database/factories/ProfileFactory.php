<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::all()->random()->id,
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'age' => $this->faker->numberBetween(28, 85)
        ];
    }
}
