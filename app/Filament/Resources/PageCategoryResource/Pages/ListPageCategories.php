<?php

namespace App\Filament\Resources\PageCategoryResource\Pages;

use App\Filament\Resources\PageCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageCategories extends ListRecords
{
    protected static string $resource = PageCategoryResource::class;
    //full width columnSpan

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array{
        return [
            PageCategoryResource\Widgets\PageCategoryOverview::class,
            PageCategoryResource\Widgets\PageCategoryChartWidget::class
        ];
    }

    
}
