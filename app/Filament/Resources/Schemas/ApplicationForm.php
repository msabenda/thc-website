<?php

namespace App\Filament\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Select::make('fee_paid')
                    ->options(['yes' => 'Yes', 'no' => 'No'])
                    ->required(),
                TextInput::make('receipt_path')
                    ->default(null),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                TextInput::make('membership_id')
                    ->default(null),
                Textarea::make('rejection_reason')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('application_ref')
                    ->required(),
            ]);
    }
}
