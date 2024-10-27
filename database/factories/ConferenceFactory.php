<?php

namespace Database\Factories;

use App\Enums\ConferenceStatus;
use App\Models\Conference;
use App\Models\Talk;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = $this->faker->dateTimeBetween('-1 year', '+1 year');

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'starts_at' => $startsAt,
            'ends_at' => $this->faker->dateTimeBetween($startsAt, '+1 year'),
            'status' => $this->faker->randomElement(ConferenceStatus::class),
            'region' => $this->faker->countryCode(),
            'venue_id' => null,
        ];
    }

    /**
     * Include a venue with the conference.
     *
     * @return Factory<Conference>
     */
    public function withVenue(?Venue $venue = null): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'venue_id' => $venue?->id ?? Venue::factory(),
            ];
        });
    }

    /**
     * Include talks with the conference.
     *
     * @return Factory<Conference>
     */
    public function withTalks(int $count = 1): Factory
    {
        return $this->afterCreating(function (Conference $conference) use ($count) {
            $conference->talks()->attach(
                Talk::factory()->count($count)->create()
            );
        });
    }
}
