<?php

namespace Database\Factories;

use App\Models\Speaker;
use App\Models\Talk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Talk>
 */
class TalkFactory extends Factory
{
    protected $model = Talk::class;

    public function definition(): array
    {
        return [
            'speaker_id' => Speaker::factory(),
            'title' => $this->faker->sentence(),
            'abstract' => $this->faker->paragraph(),
        ];
    }
}
