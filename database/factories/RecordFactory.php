<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Record;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomPressure = $this->faker->numberBetween(48, 256);
        $randomDateTime = Carbon::now()->subDays(rand(1, 365 * 3));

        return [
            'profile_id' => Profile::all()->random()->id,
            'systolic' => $randomPressure,
            'diastolic' => $randomPressure - rand(24, 36),
            'pulse' => $this->faker->randomElement([$randomPressure - rand(5, 10), $randomPressure + rand(5, 10)]),
            'is_irregular_hb' => $this->faker->randomElement([true, false, false, false, false]),
            'pulse_pressure' => $randomPressure - rand(5, 15),
            'mean_arterial_pressure' => $randomPressure - rand(5, 15),
            'location' => $this->faker->randomElement(['Left Arm', 'Right Arm']),
            'posture' => $this->faker->randomElement(['seated', 'seated', 'seated', 'seated', 'standing']),
            'note' => $this->faker->sentence,
            'created_at' => $randomDateTime,
            'updated_at' => $randomDateTime
        ];
    }
}
