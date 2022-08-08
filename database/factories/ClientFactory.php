<?php

namespace Database\Factories;

use App\Models\Admin\BusinessField;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address,
            "business_field_id" => BusinessField::inRandomOrder(),
            "user_id" => User::inRandomOrder()
        ];
    }
}
