<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\ButtonAction;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->required()
                ,
                TextInput::make('name')
                    ->required()
                ,
                Toggle::make('is_primary')
                    ->disabled(fn($record, $livewire) => $livewire instanceof EditRecord ? $record->is_primary : false),
                Select::make('source_tenant')
                    ->label('Copy from')
                    ->options(Tenant::all()->pluck('id', 'id'))
                    ->searchable()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
                Tables\Columns\BooleanColumn::make('is_primary'),
                Tables\Columns\TextColumn::make('source_tenant'),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                ButtonAction::make('addDomain')
                    ->action(function (Tenant $record, array $data): void {
                        $record->domains()->create(['domain' => $data['domain']]);
                    })
                    ->form([
                        Forms\Components\TextInput::make('domain')
                            ->label('Domain')
                            ->required(),
                    ])
            ]);

    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\DomainsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
