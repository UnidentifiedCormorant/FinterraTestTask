<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'transferredMoney' => $this->faker->numberBetween(10, 10000),
            'status' => 1,
            'user_id' => User::get()->random()->id,
            'getter_id' => User::get()->random()->id,
        ];
    }
}
