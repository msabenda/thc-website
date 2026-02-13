<?php

namespace App\Filament\Resources\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('fee_paid')
                    ->badge(),
                TextColumn::make('receipt')
                    ->label('Receipt')
                    ->formatStateUsing(fn ($record) => $record) // pass whole record
                    ->view('filament.resources.application-resource.receipt-preview')
                     ->sortable(false),
                TextColumn::make('receipt_path')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('membership_id')
                    ->searchable(),
                TextColumn::make('application_ref')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('receipt')
                    ->label('Receipt')
                    ->formatStateUsing(fn ($record) => $record) // pass whole record
                    ->view('filament.resources.application-resource.receipt-preview')
                     ->sortable(false),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
