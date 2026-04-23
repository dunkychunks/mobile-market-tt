<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Events\OrderPaid;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

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
                /*
                 * Fires the same OrderPaid event that Stripe fires on successful payment,
                 * so tier upgrade logic runs consistently regardless of payment method.
                 */
                Action::make('markPaid')
                    ->label('Mark as Paid')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->payment_status === 'pending')
                    ->requiresConfirmation()
                    ->action(function (Order $record): void {
                        $record->update(['payment_status' => 'paid']);
                        OrderPaid::dispatch($record);

                        Notification::make()
                            ->title('Order marked as paid. Tier updated if applicable.')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
