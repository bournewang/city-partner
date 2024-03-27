<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppResource\Pages;
use App\Filament\Resources\AppResource\RelationManagers;
use App\Models\App;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppResource extends Resource
{
    protected static ?string $model = App::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->label("App Name")->translateLabel(),
                TextInput::make('data')->label("App Data")->translateLabel(),
                SpatieMediaLibraryFileUpload::make("attachments")->label("Icon")->collection("icon")->conversion("thumb"),
                // TextInput::make('mobile')->translateLabel(),
                Select::make('status')->options([0 => "Disabled", 1 => "Enabled", ])->translateLabel(),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                ->columns(3)
                ->schema([
                    TextEntry::make("name")->label('App Name')->translateLabel(),
                    TextEntry::make("data")->label('App Data')->translateLabel(),
                    SpatieMediaLibraryImageEntry::make('attachments')->label("Icon")->translateLabel()->collection('icon'),

                    TextEntry::make("created_at")->translateLabel(),
                    // TextEntry::make("status")->translateLabel()
                        // ->formatStateUsing(fn (string $state): View =>
                        // view('filament.infolists.components.challenge-status', ['state' => $state])),
                ])
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")->label("App Name")->translateLabel(),
                TextColumn::make("data")->label("App Data")->translateLabel(),
                ToggleColumn::make("status")->translateLabel(),
                    // ->view('filament.tables.columns.challenge-status')
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApps::route('/'),
            'create' => Pages\CreateApp::route('/create'),
            'view' => Pages\ViewApp::route('/{record}'),
            'edit' => Pages\EditApp::route('/{record}/edit'),
        ];
    }
}
