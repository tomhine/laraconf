<?php

namespace Database\Factories;

use App\Enums\Region;
use App\Models\Conference;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(rand(1, 3), true);

        if (is_array($name)) {
            $name = implode(' ', $name);
        }

        return [
            'name' => Str::title($name),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'region' => $this->faker->randomElement(Region::class),
        ];
    }

    /**
     * Include a conference with the venue.
     *
     * @return Factory<Venue>
     */
    public function withConference(?Conference $conference = null): Factory
    {
        return $this->state(function (array $attributes) use ($conference) {
            return [
                'venue_id' => $conference->id ?? Conference::factory(),
            ];
        });
    }

    /**
     * Specify a region for the venue.
     *
     * @return Factory<Venue>
     */
    public function region(Region $region): Factory
    {
        return $this->state(function (array $attributes) use ($region) {
            return [
                'region' => $region,
            ];
        });
    }
}
