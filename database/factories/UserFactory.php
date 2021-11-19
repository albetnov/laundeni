<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Outlet;

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
        return [
            'id_outlet' => Outlet::factory(),
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'role' => $this->faker->randomElement(['admin'], ['kasir'], ['owner'], ['disabled']),
            'password' => '$2y$10$qXCoMe3wm.Y2Txeww7MiY.dWqlwhMegP3WGSKgv0MxWHr.vh2Q1p2', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
