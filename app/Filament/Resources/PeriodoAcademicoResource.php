<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodoAcademicoResource\Pages;
use App\Filament\Resources\PeriodoAcademicoResource\RelationManagers;
use App\Models\Periodo_academico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodoAcademicoResource extends Resource
{
    protected static ?string $model = Periodo_academico::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('año')
                ->required()
                ->maxLength(4)
                ->numeric()
                ->label('Año'),
            Forms\Components\TextInput::make('trimestre')
                ->required()
                ->maxLength(255)
                ->label('Trimestre'),
            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255)
                ->label('Nombre'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('nombre') // Columna para mostrar el nombre
                ->sortable()
                ->searchable()
                ->label('Nombre'),

            Tables\Columns\TextColumn::make('año') // Columna para mostrar el año
                ->sortable()
                ->searchable()
                ->label('Año'),

            Tables\Columns\TextColumn::make('trimestre') // Columna para mostrar el trimestre
                ->sortable()
                ->searchable()
                ->label('Trimestre'),

            Tables\Columns\TextColumn::make('created_at') // Columna para mostrar la fecha de creación
                ->sortable()
                ->label('Fecha de Creación')
                ->dateTime(),
        ])
        ->filters([
            // Filtros pueden añadirse aquí si es necesario
        ])
        ->actions([
            Tables\Actions\EditAction::make(), // Acción de edición
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([ // Acciones en grupo
                Tables\Actions\DeleteBulkAction::make(), // Acción de eliminación en grupo
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
            'index' => Pages\ListPeriodoAcademicos::route('/'),
            'create' => Pages\CreatePeriodoAcademico::route('/create'),
            'edit' => Pages\EditPeriodoAcademico::route('/{record}/edit'),
        ];
    }
}
