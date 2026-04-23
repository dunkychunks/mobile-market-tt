<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Groups\GroupResource;
use App\Filament\Resources\Messages\MessageResource;
use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Shippings\ShippingResource;
use App\Filament\Resources\Tiers\TierResource;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Widgets\StoreStatsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Mobile Market TT')
            ->colors([
                'primary' => Color::Amber,
            ])
            /*
             * Explicit registration is used instead of discoverResources/discoverWidgets
             * to avoid filesystem scanning on every request, which was causing slow loads.
             */
            ->resources([
                ProductResource::class,
                UserResource::class,
                GroupResource::class,
                OrderResource::class,
                ShippingResource::class,
                TierResource::class,
                MessageResource::class,
            ])
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
                StoreStatsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationItems([
                NavigationItem::make('Store')
                    ->url(fn(): string => route('store.index'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-shopping-cart')
                    ->sort(1),
            ]);;
    }
}
