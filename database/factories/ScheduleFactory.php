<?php

namespace Database\Factories;

use App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\service>
 */
class ScheduleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'doctor_id' => Doctor::factory(),
            'day' => fake()->dayOfWeek(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
        ];
    }
}
