<?php

namespace App\Models;

use App\Enums\Region;
use Database\Factories\VenueFactory;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    /** @use HasFactory<VenueFactory> */
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'region' => Region::class,
    ];

    /**
     * A Venue has many conferences.
     *
     * @return HasMany<Conference, $this>
     */
    public function conferences(): HasMany
    {
        return $this->hasMany(Conference::class);
    }

    /**
     * Get the form schema for the Venue model.
     *
     * @return list<Component>
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('city')
                ->required()
                ->maxLength(255),
            TextInput::make('country')
                ->required()
                ->maxLength(255),
            TextInput::make('postal_code')
                ->required()
                ->maxLength(255),
            Select::make('region')
                ->enum(Region::class)
                ->options(Region::class)
                ->required(),
        ];
    }
}
