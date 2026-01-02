<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use filament\forms\components\FileUpload;
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Project gw';
    protected static ?string $pluralModelLabel = 'Project gw';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Detail Project')
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail Project')
                    ->image()
                    ->directory('projects')
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->required(false),
                Forms\Components\Textarea::make('deskripsi_pendek')
                    ->rows(3),
                Forms\Components\Textarea::make('deskripsi_lengkap')
                    ->columnSpanFull()
                        ])
                    ->columns(2),
            Forms\Components\Section::make('Informasi Tambahan')
            ->schema([
                Forms\Components\TextInput::make('linkdemo')
                    ->label('Link Demo')
                    ->url(),
                Forms\Components\TextInput::make('linkgithub')
                    ->label('Link GitHub')
                    ->url(),
                Forms\Components\Toggle::make('prioritas')
                    ->label('Prioritas'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->visible(fn (callable $get) => $get('status') === 'published'),
            ])
            ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkdemo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkgithub')
                    ->searchable(),
                Tables\Columns\IconColumn::make('prioritas')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'draft' => 'secondary',
                    'published' => 'success',
                ]),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
