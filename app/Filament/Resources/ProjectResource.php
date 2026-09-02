<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Models\Sphere;
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
                        $col = Schema::hasColumn('spheres', 'name') ? 'name' : 'title';
                        
                        $spheresList = Sphere::query()
                            ->whereNotNull($col)
                            ->pluck($col, $col)
                            ->toArray();

                        $projectSpheres = Project::query()
                            ->whereNotNull('sphere')
                            ->where('sphere', '!=', '')
                            ->pluck('sphere', 'sphere')
                            ->toArray();

                        return array_unique(array_merge($spheresList, $projectSpheres));
                    })
                    ->searchable(),

                Forms\Components\Select::make('year')
                    ->label('Год')
                    ->options(function () {
                        return Project::query()
                            ->whereNotNull('year')
                            ->where('year', '!=', '')
                            ->pluck('year', 'year')
                            ->unique()
                            ->toArray();
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

                Forms\Components\Repeater::make('gallery')
                    ->label('Галерея (перетаскивайте карточки для порядка)')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Фото')
                            ->image()
                            ->directory('projects/gallery')
                    ])
                    ->grid(4)
                    ->reorderable()
                    ->addActionLabel('+ Добавить фото')
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
