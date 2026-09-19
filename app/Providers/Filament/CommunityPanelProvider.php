<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CommunityPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('community')
            ->path('community')
            ->login()
            ->brandName('Cộng đồng Hội Thánh')
            ->colors([
                'primary' => Color::Emerald, // màu khác Admin panel (thường là Indigo) để dễ phân biệt bằng mắt
            ])
            // Discovery path RIÊNG BIỆT với Admin panel (app/Filament/Resources)
            // để 2 panel không đọc nhầm resource của nhau.
            ->discoverResources(
                in: app_path('Filament/Community/Resources'),
                for: 'App\\Filament\\Community\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Community/Pages'),
                for: 'App\\Filament\\Community\\Pages'
            )
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Community/Widgets'),
                for: 'App\\Filament\\Community\\Widgets'
            )
            ->widgets([
                Widgets\AccountWidget::class,
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
            ]);
    }
}