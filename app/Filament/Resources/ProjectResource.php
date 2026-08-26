<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Sphere;
use App\Models\Year;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Проекты';
    protected static ?string $modelLabel = 'проект';
    protected static ?string $pluralModelLabel = 'Проекты';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Название проекта')
                    ->placeholder('Например: Ребрендинг E-commerce платформы'),

                Forms\Components\Select::make('sphere')
                    ->label('Сфера / Отрасль')
                    ->options(Sphere::pluck('name', 'name'))
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Название сферы')
                            ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return Sphere::create($data)->name;
                    }),

                Forms\Components\Select::make('year')
                    ->label('Год реализации')
                    ->options(Year::pluck('name', 'name'))
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Год')
                            ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return Year::create($data)->name;
                    }),

                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->disk('public')
                    ->directory('projects')
                    ->label('Главная обложка проекта'),

                Forms\Components\FileUpload::make('gallery')
                    ->label('Дополнительные скриншоты (галерея)')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->disk('public')
                    ->directory('projects/gallery')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('project_url')
                    ->url()
                    ->label('Ссылка на готовый проект')
                    ->placeholder('https://example.com'),

                Forms\Components\RichEditor::make('description')
                    ->label('Описание задач и результатов')
                    ->placeholder('Какая задача стояла перед командой, ваши действия в роли руководителя и итоговый бизнес-результат...')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Обложка'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Название'),

                Tables\Columns\TextColumn::make('sphere')
                    ->badge()
                    ->sortable()
                    ->label('Сфера'),

                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->label('Год'),
            ])
            ->reorderable('sort')
            ->defaultSort('sort', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}