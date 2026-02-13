<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Pages\CreateApplication;
use App\Filament\Resources\Pages\EditApplication;
use App\Filament\Resources\Pages\ListApplications;
use App\Filament\Resources\Schemas\ApplicationForm;
use App\Filament\Resources\Tables\ApplicationsTable;
use App\Models\Application;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
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
                ->formatStateUsing(fn ($record) => $record) // pass record to view
                ->view('filament.resources.application-resource.receipt-preview'),
            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger',
                }),
            TextColumn::make('membership_id')
                ->searchable(),
            TextColumn::make('application_ref')
                ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            \Filament\Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve Membership Application')
                ->modalDescription('This will generate a membership ID and email the applicant.')
                ->modalSubmitActionLabel('Approve Now')
                ->action(function (Application $record) {
                    if ($record->status !== 'pending') {
                        \Filament\Notifications\Notification::make()
                            ->title('Cannot approve')
                            ->body('Application is already ' . $record->status)
                            ->danger()
                            ->send();
                        return;
                    }

                    // Generate unique Membership ID: THC-2026-ABC123
                    $year = now()->year;
                    do {
                        $random = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(6));
                        $membershipId = "THC-{$year}-{$random}";
                    } while (Application::where('membership_id', $membershipId)->exists());

                    $record->update([
                        'status' => 'approved',
                        'membership_id' => $membershipId,
                    ]);

                    // Send email
                    \Illuminate\Support\Facades\Mail::to($record->email)
                        ->queue(new \App\Mail\MembershipApproved($record, $membershipId));

                    \Filament\Notifications\Notification::make()
                        ->title('Application Approved')
                        ->body("Membership ID: **{$membershipId}** sent to applicant.")
                        ->success()
                        ->send();
                }),

            \Filament\Tables\Actions\Action::make('reject')
                ->label('Reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->form([
                    \Filament\Forms\Components\Textarea::make('rejection_reason')
                        ->label('Reason for rejection (will be sent to applicant)')
                        ->placeholder('e.g. Invalid receipt, duplicate application, etc.')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (Application $record, array $data) {
                    if ($record->status !== 'pending') {
                        \Filament\Notifications\Notification::make()
                            ->title('Cannot reject')
                            ->body('Application is already ' . $record->status)
                            ->danger()
                            ->send();
                        return;
                    }

                    $record->update([
                        'status' => 'rejected',
                        'rejection_reason' => $data['rejection_reason'],
                    ]);

                    \Illuminate\Support\Facades\Mail::to($record->email)
                        ->queue(new \App\Mail\MembershipRejected($record));

                    \Filament\Notifications\Notification::make()
                        ->title('Application Rejected')
                        ->success()
                        ->send();
                }),

            \Filament\Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            \Filament\Tables\Actions\BulkActionGroup::make([
                \Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListApplications::route('/'),
            'create' => CreateApplication::route('/create'),
            'edit' => EditApplication::route('/{record}/edit'),
        ];
    }
}