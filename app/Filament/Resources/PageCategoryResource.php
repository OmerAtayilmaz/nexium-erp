<?php

namespace App\Filament\Resources;

use App\Enums\PageStatus;
use App\Filament\Resources\PageCategoryResource\Pages;
use App\Filament\Resources\PageCategoryResource\RelationManagers;
use App\Models\PageCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageCategoryResource extends Resource
{
    protected static ?string $model = PageCategory::class;

    protected static ?string $navigationGroup = 'Web Yönetimi';
    protected static ?string $navigationLabel = 'Kategoriler';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(400),
                    Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(PageStatus::class)
                   ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ,
                Tables\Columns\TextColumn::make('status')
                    ->searchable()->sortable()->badge()->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')->default(),
                \Filament\Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
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
            'index' => Pages\ListPageCategories::route('/'),
      //      'create' => Pages\CreatePageCategory::route('/create'),
     //       'edit' => Pages\EditPageCategory::route('/{record}/edit'),
        ];
    }

    public static function getWidgets() : array {
        return [
            PageCategoryResource\Widgets\PageCategoryOverview::class            
        ];
    }
}
