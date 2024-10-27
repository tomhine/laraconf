<?php

namespace App\Models;

use Database\Factories\TalkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Talk extends Model
{
    /** @use HasFactory<TalkFactory> */
    use HasFactory;

    /**
     * A talk belongs to a speaker.
     *
     * @return BelongsTo<Speaker, $this>
     */
    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    /**
     * A talk belongs to many conferences.
     *
     * @return BelongsToMany<Conference, $this>
     */
    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }
}
