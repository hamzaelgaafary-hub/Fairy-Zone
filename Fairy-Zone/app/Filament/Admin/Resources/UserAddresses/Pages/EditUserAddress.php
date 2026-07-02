<?php

namespace App\Filament\Admin\Resources\UserAddresses\Pages;

use App\Filament\Admin\Resources\UserAddresses\UserAddressResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserAddress extends EditRecord
{
    protected static string $resource = UserAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
