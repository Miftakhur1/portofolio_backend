<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Skil';
    protected static ?string $pluralModelLabel = 'Skil';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Skill')
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama Skill')
                    ->maxLength(100),
                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'frontend' => 'Frontend',
                        'backend' => 'Backend',
                        'database' => 'Database',
                        'other' => 'Other',
                    ])
                    ->searchable(),
                Forms\Components\Select::make('level')
                    ->label('Level')
                    ->options([
                        'Pemula' => 'Pemula',
                        'Menengah' => 'Menengah',
                        'Mahir' => 'Mahir',
                    ]),
                ]),
                Forms\Components\TextInput::make('persentase')
                        ->label('Persentase Kemampuan')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),
                Forms\Components\TextInput::make('icon')
                     ->label('Icon (opsional)')
                            ->helperText('Contoh: laravel, react, js'),
            
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('persentase')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
