<?php

namespace App\Providers\Filament;

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
                ->label(trans('navigation.pdms'))
                ->icon('heroicon-o-wallet')
                ->url('/pdms')
                ->sort(0),
            MenuItem::make()
                ->label(trans('navigation.admin'))
                ->icon('heroicon-o-shield-check')
                ->url('/admin')
                ->sort(1),
            MenuItem::make()
                ->label(trans('navigation.system'))
                ->icon('heroicon-o-cog-8-tooth')
                ->url('/system')
                ->sort(1),
        ];
    }
}
