<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            /*
             * For demo purposes only — does not send an actual email.
             * Marks email_verified_at = now() so the user passes the verified check.
             */
            Action::make('sendVerificationEmail')
                ->label('Send Verification Email')
                ->icon('heroicon-o-envelope')
                ->color('info')
                ->action(function (): void {
                    $this->getRecord()->update(['email_verified_at' => now()]);

                    Notification::make()
                        ->title('Verification email sent. User is now verified for demo purposes.')
                        ->success()
                        ->send();
                }),
            DeleteAction::make(),
        ];
    }
}
