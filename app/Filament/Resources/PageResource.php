<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Models\PageCategory;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


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
                    ->maxSize(10 * 1024 * 1024) // 10mb
                    ->columnSpanFull()
                    ->imageEditor()
                    ->directory('page_images')
                    //Dosya adını korur - bad practice -> preserveFileName()
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
                    ->searchable()
                    
                    ->limit(10)
                    ->extraAttributes(['class' => 'border rounded-xl'])
                    ->description(function(Page $page){
                        return Str::of($page['keywords'])->limit(5);
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->description('Sayfa kategorileri')
                    ->sortable()
                    ->limit(5)
                    ->searchable(),
                    
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Öne Çıkan Görsel')
                    ->width(200)
                    ->height(100),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Action::make(name: 'status')
                    ->label('fill Form')
                    ->icon('heroicon-o-star')
                    ->action(function($livewire){
                        Notification::make()->success()->title('User updated')->body('The user has been saved successfully.')->send();
                    }),
                ]),
     
                
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
