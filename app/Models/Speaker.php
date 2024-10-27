<?php

namespace App\Models;

use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    /** @use HasFactory<SpeakerFactory> */
    use HasFactory;

    /**
     * A speaker has many talks.
     *
     * @return HasMany<Talk, $this>
     */
    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class);
    }

    /**
     * A speaker belongs to many conferences.
     *
     * @return BelongsToMany<Conference, $this>
     */
    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }
}
