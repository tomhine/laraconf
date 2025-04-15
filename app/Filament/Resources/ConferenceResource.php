<?php

namespace App\Filament\Resources;

use App\Enums\ConferenceStatus;
use App\Enums\Region;
use App\Filament\Resources\ConferenceResource\Pages;
use App\Models\Conference;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ConferenceResource extends Resource
{
    protected static ?string $model = Conference::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(60),
                Forms\Components\Select::make('status')
                    ->enum(ConferenceStatus::class)
                    ->options(ConferenceStatus::class)
                    ->required()
                    ->default(ConferenceStatus::Upcoming),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->disableToolbarButtons(['attachFiles'])
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('starts_at')
                    ->required()
                    ->native(false),
                Forms\Components\DateTimePicker::make('ends_at')
                    ->required()
                    ->after('starts_at')
                    ->native(false),
                Forms\Components\Select::make('region')
                    ->enum(Region::class)
                    ->options(Region::class)
                    ->required()
                    ->live(),
                Forms\Components\Select::make('venue_id')
                    ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Forms\Get $get) {
                        return $query->where('region', $get('region'));
                    })
                    ->default(null)
                    ->native(false)
                    ->live(),
                Forms\Components\Checkbox::make('is_published'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('venue.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConferences::route('/'),
            'create' => Pages\CreateConference::route('/create'),
            'edit' => Pages\EditConference::route('/{record}/edit'),
        ];
    }
}
