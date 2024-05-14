<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeEmail;
use App\Models\Wallet; 

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $user = $this->getRecord();

        // Send a welcome email to the newly created user
        Mail::to($user->email)->send(new NewUserWelcomeEmail($user));

        // Insert data into the wallet table
        $wallet = new Wallet();
        $wallet->Wallet_ID = $user->id; // Assuming Wallet_ID is linked to user id
        $wallet->Balance = 0; // Set balance to 0
        $wallet->CreationTimeDate = now(); // Set current date and time
        $wallet->LastTransactionTimeDate = null; // Set LastTransactionTimeDate to null
        $wallet->id = $user->id; // Set id to user id
        $wallet->save();
    }
}