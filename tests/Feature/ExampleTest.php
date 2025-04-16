<?php

use App\Models\Conference;

test('homepage redirects to login', function () {
    $this->get('/')
        ->assertRedirect('/login');
});

test('conference factory works', function () {
    $conference = Conference::factory()->withVenue()->create();

    $this->assertDatabaseHas('conferences', [
        'id' => $conference->id,
        'name' => $conference->name,
        'starts_at' => $conference->starts_at,
        'ends_at' => $conference->ends_at,
        'venue_id' => $conference->venue_id,
        'status' => $conference->status,
    ]);
});
