<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name'),
                TextInput::make('nickname'),
                TextInput::make('mobile'),
                TextInput::make('status'),
                TextInput::make('level'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                // TextColumn::make("openid")->label(__("OpenId"))->searchable(),
                // TextColumn::make("platform_openid")->label(__("platform_openid"))->searchable(),
                TextColumn::make("name")->label(__("Name"))->searchable(),
                TextColumn::make("nickname")->label(__("Nickname"))->searchable(),
                // TextColumn::make("email")->label(__("Email"))->searchable()
                TextColumn::make("mobile")->label(__("Mobile"))->searchable(),
                ToggleColumn::make("status")->label(__("Status")),
                TextColumn::make("level")->label(__("Level")),
                TextColumn::make("referer.name")->label(__("Referer")),
                TextColumn::make("recommands_count")->label(__("Recommands"))->counts('recommands'),
                TextColumn::make("created_at")->translateLabel() //label(__("Created At")),
            ])
            ->filters([
                //
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make("openid")->label(__("OpenId")),
                TextEntry::make("platform_openid")->label(__("Platform Openid")),
                TextEntry::make("name")->label(__("Name")),
                TextEntry::make("nickname")->label(__("Nickname")),
                // TextColumn::make("email")->label(__("Email"))->searchable()
                TextEntry::make("mobile")->label(__("Mobile")),
                TextEntry::make("status")->label(__("Status")),
                TextEntry::make("level")->label(__("Level")),
                TextEntry::make("referer.name")->label(__("Referer")),
                TextEntry::make("created_at")->label("Created At"),
                // TextEntry::make("recommands")->label(__("Recommands"))->counts('recommands'),
                // Infolists\Components\TextEntry::make('name'),
                // Infolists\Components\TextEntry::make('email'),
                // Infolists\Components\TextEntry::make('notes')
                    // ->columnSpanFull(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\Viewuser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
