<?php

namespace App\Models;

use App\Enums\PageStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'published_at',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'published_at' => 'timestamp',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public static function getForm(){
        return [
            TextInput::make('title')
                ->required()
                ->maxLength(400),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            DateTimePicker::make('published_at'),
            Select::make('status')
                ->required()
                ->options(PageStatus::class)
               ,
        ];
    }
}
