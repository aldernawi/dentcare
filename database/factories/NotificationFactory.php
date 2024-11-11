<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $notifiableType = $this->faker->randomElement(['App\Models\User', 'App\Models\Doctor']);
        $notifiableId = $this->getRandomIdForType($notifiableType);
        return [
            'notifiable_type' => $notifiableType,
            'notifiable_id' => $notifiableId,
            'data' => json_encode([
                'title' => $this->faker->sentence,
                'message' => $this->faker->paragraph,
            ]),


        ];
    }
    protected function getRandomIdForType($type)
    {
        switch ($type) {
            case 'App\Models\User':
                return \App\Models\User::inRandomOrder()->first()->id;
            case 'App\Models\Doctor':
                return \App\Models\Doctor::inRandomOrder()->first()->id;
            default:
                return null;
        }
    }
}
