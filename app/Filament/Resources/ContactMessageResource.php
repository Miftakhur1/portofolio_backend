<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Pesan Masuk';
    protected static ?string $pluralModelLabel = 'Pesan Masuk';
     public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'pesan'  => 'required|string|max:1000',
            'subjek' => 'nullable|string|max:255',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'message' => 'Pesan berhasil dikirim',
        ], 201);
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Pesan Masuk')
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('email')
                    ->disabled(),
                Forms\Components\TextInput::make('subjek')
                    ->disabled(),
                Forms\Components\Textarea::make('pesan')
                    ->rows(6)
                    ->disabled(),
                Forms\Components\Toggle::make('dibaca')
                    ->label('Dibaca'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subjek')
                    ->searchable(),
                Tables\Columns\IconColumn::make('dibaca')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Diterima Pada')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
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
            'index' => Pages\ListContactMessages::route('/'),
        ];
    }
}
