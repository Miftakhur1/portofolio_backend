<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Filament\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengalaman Kerja';
    protected static ?string $pluralModelLabel = 'Pengalaman Kerja';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Experience')
            ->schema([
                Forms\Components\TextInput::make('nama_perusahaan')
                    ->required()
                    ->label('Nama Perusahaan'),
                Forms\Components\TextInput::make('posisi')
                    ->required()
                    ->label('Posisi'),
                Forms\Components\Select::make('tipe_pekerjaan')
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'freelance' => 'Freelance',
                        'Magang' => 'Magang',
                    ]),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai'),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->visible(fn (callable $get) => ! $get('masih_bekerja')),
                Forms\Components\Toggle::make('masih_bekerja')
                    ->default(false)
                    ->label('Masih Bekerja'),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->label('Deskripsi')
                    ->rows(4),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_perusahaan')
                    ->searchable()
                    ->sortable()
                    ->label('Perusahaan'),
                Tables\Columns\TextColumn::make('posisi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe_pekerjaan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'full_time' => 'success',
                        'part_time' => 'warning',
                        'freelance' => 'primary',
                        'Magang' => 'info',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('masih_bekerja')
                    ->boolean()
                    ->label('Masih Bekerja'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal_mulai', 'desc')
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
