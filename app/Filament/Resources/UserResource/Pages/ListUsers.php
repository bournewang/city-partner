<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

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
        return [
            __('All') => Tab::make(),
            // __('Active') => Tab::make()
            //     ->modifyQueryUsing(fn (Builder $query) => $query->where('status', true)),
            // __('Inactive') => Tab::make()
            //     ->modifyQueryUsing(fn (Builder $query) => $query->where('status', false)),
            __("Register Consumers")   => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::REGISTER_CONSUMER)),
            __("Partner Consumers")    => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::PARTNER_CONSUMER)),
            __("Appoint Consumer Managers") => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::CONSUMER_MERCHANT)),
            __("station_manager")      => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::COMMUNITY_STATION)),
            __("center_director")      => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::RUN_CENTER_DIRECTOR)),
            __("county_manager")       => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::COUNTY_MANAGER)),
            __("area_president")       => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::AREA_PRESIDENT)),
            __("province_management")  => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('level', User::PROVINCE_CEO)),

        ];
    }
}
