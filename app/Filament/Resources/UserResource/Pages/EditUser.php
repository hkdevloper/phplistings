<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Models\WalletHistory;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * @throws \Throwable
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If admin added the balance, then add the wallet history for the user
        if (array_key_exists('balance', $data)) {
            // Find user by email
            $user = User::where('email', $data['email'])->firstOrFail();
            // if the balance is not equal to the user balance, then add the wallet history
            if ($user->balance != $data['balance']) {
                $type = $user->balance < $data['balance'] ? 'credit' : 'debit';
                $amount = $type == 'credit' ? $data['balance'] - $user->balance : $user->balance - $data['balance'];
                $transaction = new WalletHistory();
                $transaction->user_id = $user->id;
                $transaction->type = $type;
                $transaction->transaction_id = 'TRX-' . time() . rand(1000, 9999);
                $transaction->amount = $amount;
                $transaction->status = 'captured';
                $transaction->method = 'admin';
                $transaction->currency = 'USD';
                $transaction->user_email = $data['email'];
                $transaction->contact = $user->company ? $user->company->phone : 'N/A';
                $transaction->fee = 0;
                $transaction->tax = 0;
                $transaction->json_response = json_encode(['message' => 'Admin added balance to the user wallet']);
                $transaction->saveOrFail();
            }
        }
        return parent::mutateFormDataBeforeSave($data); // TODO: Change the autogenerated stub
    }
}
