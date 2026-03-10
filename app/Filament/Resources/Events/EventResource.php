<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\ManageEvents;
use App\Models\Event;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen Event';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('event_category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul Acara')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->dehydrated(),
                FileUpload::make('thumbnail')
                    ->label('Gambar/Thumbnail Acara')
                    ->image()
                    ->directory('events') 
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),
                Grid::make(3)
                ->schema([
                    DatePicker::make('event_date')
                        ->label('Tanggal Acara')
                        ->required(),
                    TimePicker::make('start_time')
                        ->label('Waktu Mulai')
                        ->prefixIcon(Heroicon::Clock)
                        ->required(),
                    TimePicker::make('end_time')
                        ->label('Waktu Selesai')
                        ->prefixIcon(Heroicon::Clock)
                        ->nullable(),
                ])->columnSpanFull(),
                TextInput::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Deskripsi Acara')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Judul Acara')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori Acara'),
                TextColumn::make('event_date')
                    ->label('Tanggal Acara')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label('Waktu Mulai')
                    ->time('H:i'),
                TextColumn::make('end_time')
                    ->label('Waktu Selesai')
                    ->time('H:i')
                    ->placeholder('-'),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageEvents::route('/'),
        ];
    }
}