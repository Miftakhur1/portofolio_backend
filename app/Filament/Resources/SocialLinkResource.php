<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Filament\Resources\SocialLinkResource\RelationManagers;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Social media';
    protected static ?string $pluralModelLabel = 'Social media';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Social Link')
                    ->schema([
                Forms\Components\Select::make('profile_id')
                    ->required()
                    ->relationship('profile','nama_lengkap')
                    ->label('Profile'),
                Forms\Components\TextInput::make('platform')
                    ->required()
                    ->label('Platform')
                    ->placeholder('Contoh: Twitter, LinkedIn, GitHub'),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->label('URL')
                    ->url(),
                Forms\Components\TextInput::make('icon')
                    ->label('Icon(opsional)')
                    ->helperText('Masukkan nama kelas ikon, misal: fab fa-twitter'),
                Forms\Components\TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                 ])
                   ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('profile.nama_lengkap')
                    ->label('Profile')
                    ->sortable(),
                Tables\Columns\TextColumn::make('platform')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('urutan')
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
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
