<?php

// En UsuariosResource (app/Filament/Resources/UsuariosResource.php)

namespace App\Filament\Resources;

use App\Filament\Resources\UsuariosResource\Pages;
use App\Models\Usuarios;
use App\Models\Roles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UsuariosResource extends Resource
{
    protected static ?string $model = Usuarios::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),

                // Aquí cambiamos el tipo de campo a Select con relationship
                Forms\Components\Select::make('tipo_rol')
                    ->relationship('rol', 'nombre')  // Relaciona el campo tipo_rol con el campo nombre del modelo Roles
                    ->required()
                    ->placeholder('Seleccione un rol'),  // Opcional: Agregar un texto de placeholder
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                
                // Mostrar el nombre del rol (esto requiere la relación en el modelo Usuarios)
                Tables\Columns\TextColumn::make('rol.nombre')  // Mostrar el nombre del rol
                    ->label('Tipo de Rol')
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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuarios::route('/create'),
            'edit' => Pages\EditUsuarios::route('/{record}/edit'),
        ];
    }
}
