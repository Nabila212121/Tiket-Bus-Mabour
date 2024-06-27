<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class QRScannerPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.q-r-scanner-page';

    protected static ?string $navigationGroup = null;

    protected static ?string $navigationBadgeTooltip = null;

    protected static ?string $navigationParentItem = null;

    protected static ?string $activeNavigationIcon = null;

    protected static ?string $navigationLabel = "QR Scanner";

    protected static ?string $title = "QR Scanner";

    protected static ?int $navigationSort = null;

    protected static bool $shouldRegisterNavigation = true;
}
