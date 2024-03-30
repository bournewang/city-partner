<?php

namespace App\Filament\Resources\ChallengeResource\Pages;

use App\Filament\Resources\ChallengeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Challenge;
use App\Models\User;
use App\Helpers\UserHelper;

class ViewChallenge extends ViewRecord
{
    protected static string $resource = ChallengeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Actions\Action::make('Confirm')
                ->translateLabel()
                ->visible(fn (): bool => $this->getRecord()->status == Challenge::APPLYING)
                ->action(function () {
                    $record = $this->getRecord();
                    if ($record->status == Challenge::APPLYING) {
                        $record->user->update(["level" => User::CONSUMER_MERCHANT]);
                        $record->update(['status' => Challenge::CHALLENGING]);
                        $this->refreshFormData(['status']);
                        // UserHelper::createQrCode($record->user);
                    }
                })
        ];
    }
}
