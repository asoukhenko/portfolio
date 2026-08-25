<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Название проекта')
                    ->placeholder('Например: Ребрендинг E-commerce платформы'),

                Forms\Components\TextInput::make('sphere')
                    ->required()
                    ->label('Сфера / Отрасль')
                    ->placeholder('Например: E-commerce, Недвижимость, FinTech'),

                Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->required()
                    ->label('Год реализации')
                    ->placeholder('2025'),

                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->disk('public')
                    ->directory('projects')
                    ->label('Обложка проекта'),

                Forms\Components\TextInput::make('project_url')
                    ->url()
                    ->label('Ссылка на готовый проект')
                    ->placeholder('https://example.com'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->rows(4)
                    ->label('Описание задач и результатов')
                    ->placeholder('Какая задача стояла перед командой, ваши действия в роли руководителя и итоговый бизнес-результат...'),
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
            ->defaultSort('year', 'desc');
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