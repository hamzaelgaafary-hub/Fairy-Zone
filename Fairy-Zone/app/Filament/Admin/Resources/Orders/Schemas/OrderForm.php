<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->required(),
                TextInput::make('order_number')
                    ->disabled()
                    ->required(),
                TextInput::make('payment_method')
                    ->required()
                    ->disabled()
                    ->default('cash_on_delivery'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->disabled()
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->disabled()
                    ->prefix('EGP')
                    ->numeric(),
                TextInput::make('shipping_name')
                    ->disabled()
                    ->required(),
                TextInput::make('shipping_phone')
                    ->disabled()
                    ->tel()
                    ->required(),
                TextInput::make('shipping_address')
                    ->disabled()
                    ->required(),
                TextInput::make('shipping_city')
                    ->disabled()
                    ->required(),
                TextInput::make('shipping_state')
                    ->disabled()
                    ->required(),
                Textarea::make('notes')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}
