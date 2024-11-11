<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\service>
 */
class ServiceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerAr = FakerFactory::create('ar_SA');
        return [
            'name' => [
                'ar' => $fakerAr->title(),
                'en' => fake()->jobTitle(),
            ],
            'desc' => [
                'ar' => $fakerAr->text(),
                'en' => fake()->text(),
            ],

            'price' => fake()->randomNumber(5),
        ];
    }
}
