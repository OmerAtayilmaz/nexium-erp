<?php

namespace App\Filament\Resources\PageResource\Widgets;

use Filament\Widgets\ChartWidget;

class PageChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        //data for pie chart

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => \App\Models\PageCategory::withCount('pages')->pluck('pages_count')->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => \App\Models\PageCategory::pluck("title")->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
