<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroResource\Pages;
use App\Filament\Resources\RegistroResource\RelationManagers;
use App\Models\Registro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('estado')
                ->required()
                ->maxLength(255),

                Forms\Components\Select::make('grupo_id')
                ->required()
                ->relationship('grupo', 'nombre'),

            Forms\Components\Select::make('curso_id')
                ->required()
                ->relationship('curso', 'nombre'),

            Forms\Components\Select::make('usuario_id')
                ->required()
                ->relationship('usuario', 'nombre'),

            Forms\Components\Select::make('periodo_academico_id') 
                ->required()
                ->relationship('periodoAcademico', 'nombre'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grupo.nombre')
                ->label('Grupo')
                ->sortable(),
                Tables\Columns\TextColumn::make('curso.nombre')
                ->label('curso')
                    ->sortable(),
                Tables\Columns\TextColumn::make('usuario.nombre')
                ->label('usuario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('periodoAcademico.nombre')
                ->label('periodo Academico')
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
            'index' => Pages\ListRegistros::route('/'),
            'create' => Pages\CreateRegistro::route('/create'),
            'edit' => Pages\EditRegistro::route('/{record}/edit'),
        ];
    }
}
