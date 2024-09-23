<?php

namespace App\Filament\Resources\PageCategoryResource\Widgets;

use App\Models\PageCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PageCategoryOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //add color to Stats

            Stat::make('Total Page Categories', PageCategory::count()),
            Stat::make('Published Page Categories', PageCategory::where('status','published')->count()),
            Stat::make('Draft Page Categories', PageCategory::where('status', 'draft')->count())
        ];
    }
}
