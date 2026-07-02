<?php

namespace App\Filament\Admin\Resources\UserAddresses\Pages;

use App\Filament\Admin\Resources\UserAddresses\UserAddressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserAddresses extends ListRecords
{
    protected static string $resource = UserAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
