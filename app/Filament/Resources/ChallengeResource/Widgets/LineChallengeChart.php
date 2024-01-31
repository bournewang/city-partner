<?php

namespace App\Filament\Resources\ChallengeResource\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Challenge;

class LineChallengeChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    public ?string $filter = 'week';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $subDays = 7;
        if ($activeFilter == 'month'){
            $subDays = 30;
        } elseif ($activeFilter == 'year'){
            $subDays = 365;
        }
        $data = Trend::model(Challenge::class)
            ->between(
                start: today()->subDays($subDays),
                end: today()->endOfDay(),
            )
            ->perDay()
            ->count();
        // \Log::debug($data);

        return [
            'datasets' => [
                [
                    'label' => 'Challenges',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            // 'today' => 'Today',
            'week' => __('Last week'),
            'month' => __('Last month'),
            'year' => __('Last year'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
