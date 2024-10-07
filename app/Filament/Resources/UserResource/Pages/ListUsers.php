<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Filament\LevelTab;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            __('All') => Tab::make(),
            ___(User::DIRECTOR) => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('operation', User::DIRECTOR)),
            ___(User::DIRECTOR_ASSISTANT) => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('operation', User::DIRECTOR_ASSISTANT)),
            __('Sales') => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('sales')),
            ___(User::NON_RESP).__('Sales') => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('sales', User::NON_RESP)),
            ___(User::RESP).__('Sales') => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('sales', User::RESP)),

        ];

        // foreach (User::levelOptions() as $level => $label) {
        //     $tabs[$label] = LevelTab::makeTab($level);
        // }
        return $tabs;
    }
}
