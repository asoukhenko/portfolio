<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Проекты';
    protected static ?string $modelLabel = 'Проект';
    protected static ?string $pluralModelLabel = 'Проекты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название проекта')
                    ->required(),

                Forms\Components\Select::make('sphere')
                    ->label('Сфера')
                    ->options(function () {
                        $fromSpheres = [];
                        if (class_exists(\App\Models\Sphere::class) && Schema::hasTable('spheres')) {
                            $col = Schema::hasColumn('spheres', 'name') ? 'name' : (Schema::hasColumn('spheres', 'title') ? 'title' : 'sphere');
                            $fromSpheres = \App\Models\Sphere::query()
                                ->whereNotNull($col)
                                ->where($col, '!=', '')
                                ->pluck($col)
                                ->toArray();
                        }

                        $fromProjects = Project::query()
                            ->whereNotNull('sphere')
                            ->where('sphere', '!=', '')
                            ->pluck('sphere')
                            ->toArray();

                        $all = array_filter(array_unique(array_merge($fromSpheres, $fromProjects)));
                        sort($all);

                        return empty($all) ? [] : array_combine($all, $all);
                    })
                    ->searchable(),

                Forms\Components\Select::make('year')
                    ->label('Год')
                    ->options(function () {
                        $fromYears = [];
                        if (class_exists(\App\Models\Year::class) && Schema::hasTable('years')) {
                            $fromYears = \App\Models\Year::query()
                                ->whereNotNull('name')
                                ->where('name', '!=', '')
                                ->pluck('name')
                                ->toArray();
                        }

                        $fromProjects = Project::query()
                            ->whereNotNull('year')
                            ->where('year', '!=', '')
                            ->pluck('year')
                            ->toArray();

                        $all = array_filter(array_unique(array_merge($fromYears, $fromProjects)));
                        rsort($all); // Сортировка по убыванию (2025, 2024, 2023...)

                        return empty($all) ? [] : array_combine($all, $all);
                    })
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('year')
                            ->label('Новый год')
                            ->required(),
                    ])
                    ->createOptionUsing(fn (array $data) => $data['year']),

                Forms\Components\TextInput::make('project_url')
                    ->label('Ссылка на сайт'),

                Forms\Components\FileUpload::make('cover_image')
                    ->label('Обложка')
                    ->image()
                    ->directory('projects/covers'),

                Forms\Components\RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('gallery')
                    ->label('Галерея')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->directory('projects/gallery')
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('Обложка'),
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable(),
                Tables\Columns\TextColumn::make('sphere')->label('Сфера'),
                Tables\Columns\TextColumn::make('year')->label('Год'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
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
