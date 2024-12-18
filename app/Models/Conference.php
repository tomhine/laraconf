<?php

namespace App\Models;

use App\Enums\ConferenceStatus;
use App\Enums\Region;
use Database\Factories\ConferenceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    /** @use HasFactory<ConferenceFactory> */
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'status' => ConferenceStatus::class,
        'is_published' => 'boolean',
        'region' => Region::class,
    ];

    /**
     * A Conference belongs to a Venue.
     *
     * @return BelongsTo<Venue, $this>
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * A Conference belongs to many Speakers.
     *
     * @return BelongsToMany<Speaker, $this>
     */
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    /**
     * A Conference belongs to many Talks.
     *
     * @return BelongsToMany<Talk, $this>
     */
    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }
}
