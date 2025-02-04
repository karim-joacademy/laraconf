<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConferenceResource\Pages\CreateConference;
use App\Filament\Resources\ConferenceResource\Pages\EditConference;
use App\Filament\Resources\ConferenceResource\Pages\ListConferences;
use App\Models\Conference;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConferenceResource extends Resource
{
    protected static ?string $model = Conference::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Conference Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                TextInput::make('region')
                    ->required()
                    ->maxLength(255),
                Select::make('venue_id')
                    ->relationship('venue', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('region')
                    ->searchable(),
                TextColumn::make('venue.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListConferences::route('/'),
            'create' => CreateConference::route('/create'),
            'edit' => EditConference::route('/{record}/edit'),
        ];
    }
}
