<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChallengeResource\Pages;
use App\Filament\Resources\ChallengeResource\RelationManagers;
use App\Models\Challenge;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;
    protected static ?string $label = "挑战";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                // TextInput::make('name'),
                Select::make('user_id')
                    ->translateLabel()
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                // TextInput::make('index_no')->translateLabel(),
                // TextInput::make('level')->translateLabel(),
                Select::make('type')->translateLabel()
                        ->options(Challenge::typeOptions()),
                Select::make('level')
                    ->translateLabel()
                    ->options(User::levelOptions()),
                TextInput::make('success_at')->translateLabel(),
                // TextInput::make('status'),
                Select::make('status')
                    ->translateLabel()
                    ->options(Challenge::statusOptions())
                    // ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make("id")->translateLabel()->searchable(),
                TextColumn::make("user.mobile")->translateLabel()->searchable(),
                // TextColumn::make("index_no")->translateLabel()->searchable(),
                // TextColumn::make("level")->translateLabel()->searchable(),
                ViewColumn::make('level')->translateLabel()
                    ->view('filament.tables.columns.user-level'),
                ViewColumn::make('type')->translateLabel()
                        ->view('filament.tables.columns.challenge-type'),
                TextColumn::make("success_at")->translateLabel()->searchable(),
                // TextColumn::make("status")->translateLabel()->searchable(),
                ViewColumn::make('status')->translateLabel()
                    ->view('filament.tables.columns.challenge-status'),
            ])
            ->defaultSort("id", "desc")
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->translateLabel(),
                        DatePicker::make('created_until')->translateLabel(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date));
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->translateLabel(),
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
            'index' => Pages\ListChallenges::route('/'),
            // 'create' => Pages\CreateChallenge::route('/create'),
            // 'edit' => Pages\EditChallenge::route('/{record}/edit'),
            'view' => Pages\ViewChallenge::route('/{record}'),
        ];
    }
}
