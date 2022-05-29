<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationFactory extends Factory
{
    protected $model = \App\Models\Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lastname' => $this->faker->lastname(),
            'firstname' => $this->faker->firstname(),
            'phone' => $this->faker->numerify('######'),
            'email' => $this->faker->unique()->safeEmail(),
            'arrival' => $this->faker->date('Y-m-d'),
            'weeknight' => $this->faker->numberBetween(1,5),
            'weekendnight' => $this->faker->numberBetween(1,2)
        ];
    }
}
