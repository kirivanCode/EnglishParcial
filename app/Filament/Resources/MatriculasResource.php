<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatriculasResource\Pages;
use App\Filament\Resources\MatriculasResource\RelationManagers;
use App\Models\Matricula;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatriculasResource extends Resource
{
    protected static ?string $model = Matricula::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Campo Estado con opciones predefinidas
            Forms\Components\Select::make('estado')
                ->label('Estado')
                ->options([
                    'aprobado' => 'Aprobado',
                    'no_aprobado' => 'No aprobado',
                    'desertado' => 'Desertado',
                    'cancelado' => 'Cancelado',
                ])
                ->required()
                ->placeholder('Selecciona estado'),
    
            // Campo Registro ID
            Forms\Components\Select::make('registro_id')
            ->relationship('usuario', 'nombre')
                ->required()
                ->placeholder('Seleccione un usuario'),

        ]);
    
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario.nombre')
                ->label('usuario')
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
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatriculas::route('/create'),
            'edit' => Pages\EditMatriculas::route('/{record}/edit'),
        ];
    }
}
