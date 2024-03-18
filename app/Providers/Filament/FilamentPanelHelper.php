<?php

namespace App\Providers\Filament;

use Auth;
use Filament\Navigation\MenuItem;

class FilamentPanelHelper
{
    /**
     * @return array<MenuItem>
     */
    public static function userMenuItems(): array
    {
        return [
            MenuItem::make()
                ->visible(fn () => Auth::check() && Auth::user()->canAccessPdmsPanel())
                ->label(trans('navigation.pdms'))
                ->icon('heroicon-o-wallet')
                ->url('/pdms')
                ->sort(0),
            MenuItem::make()
                ->visible(fn () => Auth::check() && Auth::user()->canAccessAdminPanel())
                ->label(trans('navigation.admin'))
                ->icon('heroicon-o-shield-check')
                ->url('/admin')
                ->sort(1),
            MenuItem::make()
                ->visible(fn () => Auth::check() && Auth::user()->canAccessSystemPanel())
                ->label(trans('navigation.system'))
                ->icon('heroicon-o-cog-8-tooth')
                ->url('/system')
                ->sort(1),
        ];
    }
}
