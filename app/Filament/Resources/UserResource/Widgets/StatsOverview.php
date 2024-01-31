<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use App\Models\User;
use DB;
class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $register_data = User::whereBetween('created_at', [today()->subDays(7), today()->endOfDay()])
            ->select(DB::raw("count(id) as total"), DB::raw("date(created_at) as created_date"))
            ->groupBy('created_date')
            ->orderBy('created_date', 'asc')
            ->pluck('total')

            ->toArray();
            // die();
        \Log::debug($register_data);
        // die();
        return [
            Stat::make(__('Register Users'), '192.1k')
                // ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($register_data)
                ->color('success'),
            Stat::make(__('Challenge Users'), '21%')
                // ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make(__('Challenge Success'), '3:12')
                // ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
