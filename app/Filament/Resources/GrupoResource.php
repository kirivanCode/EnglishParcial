<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoResource\Pages;
use App\Filament\Resources\GrupoResource\RelationManagers;
use App\Models\Grupo;
use App\Models\Usuarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupoResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('docente_id')
                ->relationship('docente', 'nombre')
                ->required()
                ->placeholder('Seleccione un usuario'),
                Forms\Components\TextInput::make('salon')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capacidad')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_finalizacion')
                    ->required(),
                Forms\Components\Select::make('curso_id')
                ->relationship('curso', 'nombre')
                ->required()
                ->placeholder('Seleccione un curso'),

                Forms\Components\Select::make('periodo_academico_id')
                ->relationship('periodoAcademico', 'nombre')
                ->required()
                ->placeholder('Seleccione un periodo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('docente.nombre')
                ->label('Usuario')
                ->sortable(),
                Tables\Columns\TextColumn::make('salon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_finalizacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('curso.nombre')
                ->label('Tipo de curso')
                ->sortable(),
                Tables\Columns\TextColumn::make('periodoAcademico.nombre')
                ->label('Periodo A')
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
            'index' => Pages\ListGrupos::route('/'),
            'create' => Pages\CreateGrupo::route('/create'),
            'edit' => Pages\EditGrupo::route('/{record}/edit'),
        ];
    }
}
