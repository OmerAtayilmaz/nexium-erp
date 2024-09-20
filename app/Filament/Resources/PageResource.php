<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Models\PageCategory;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Web Yönetimi';
    protected static ?string $navigationLabel = 'Sayfalar';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->preload()
                    ->label('Sayfa Kategorisi')
                    ->searchable()
                    ->columnSpanFull()
                    ->editOptionForm(PageCategory::getForm())
                    ->createOptionForm(PageCategory::getForm()),
                Fieldset::make('SEO Alanları')->schema([
                    Forms\Components\TextInput::make('Başlık')
                        ->label('Başlık')
                        ->required()

                        ->maxLength(255),
                    Forms\Components\TextInput::make('Anahtar Kelimeler')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('Açıklama')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('Url')
                        ->required()
                        ->maxLength(255),
                ]),

                Forms\Components\FileUpload::make('Öne Çıkan Görsel')
                    ->image()
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\RichEditor::make('Sayfa İçeriği')
                    ->required()

                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->limit(55)

                    ->extraAttributes(['class' => 'border rounded-xl'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->description('Sayfa kategorileri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keywords')
                    ->label('Anahtar Kelimeler')
                    ->sortable()
                    ->toggleable(true)
                    ->searchable(),


                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Öne Çıkan Görsel')
                    ->width(200)
                    ->height(100),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportAction::make()
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
