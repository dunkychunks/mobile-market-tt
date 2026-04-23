<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_no')
                    ->label('Order #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subtotal')
                    ->money('usd')
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('usd')
                    ->sortable(),
                TextColumn::make('shipping.title')
                    ->label('Shipping')
                    ->default('—'),
                TextColumn::make('payment_method')
                    ->label('Pay Method')
                    ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state ?? 'N/A')))
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'paid'    => 'success',
                        'unpaid'  => 'warning',
                        'pending' => 'info',
                        default   => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }
}
