<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'        => fake()->firstName(),
            'last_name'         => fake()->lastName(),
            'username'          => fake()->unique()->userName(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('123'),
            'remember_token'    => Str::random(10),
            'phone'             => fake()->phoneNumber(),
            'gender'            => fake()->randomElement(['male', 'female']),
            'is_active'         => true,
            'registration_type' => 'manual',
            'avatar'            => null,
            'last_activity'     => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the user is male.
     */
    public function male(): static
    {
        return $this->state(fn(array $attributes) => [
            'first_name' => fake()->firstNameMale(),
            'gender'     => 'male',
        ]);
    }

    /**
     * Indicate that the user is female.
     */
    public function female(): static
    {
        return $this->state(fn(array $attributes) => [
            'first_name' => fake()->firstNameFemale(),
            'gender'     => 'female',
        ]);
    }

    /**
     * Indicate user registered via Google OAuth.
     */
    public function google(): static
    {
        return $this->state(fn(array $attributes) => [
            'registration_type' => 'google',
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Indicate user registered via Facebook OAuth.
     */
    public function facebook(): static
    {
        return $this->state(fn(array $attributes) => [
            'registration_type' => 'facebook',
            'email_verified_at' => now(),
        ]);
    }
}
