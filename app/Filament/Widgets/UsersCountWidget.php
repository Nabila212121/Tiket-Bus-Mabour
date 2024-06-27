<?php

namespace App\Filament\Widgets;

use App\Models\BusTicket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UsersCountWidget extends BaseWidget
{

    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', $this->getUsersHasOrder())->icon('heroicon-o-user-group')->description('Total users that has order'),
            Stat::make('Total Order Selesai', $this->getOrderCompleted())->icon('heroicon-o-user-group')->description('Total users that has order'),
            Stat::make('Total Order Dibatalkan', $this->getOrderCanceled())->icon('heroicon-o-user-group')->description('Total users that has order'),
        ];
    }

    protected function getUsersHasOrder()
    {
        return User::whereHas('busTicket')->count();
    }
    protected function getOrderCompleted()
    {
        return BusTicket::where('status', 'completed')->count();
    }
    protected function getOrderCanceled()
    {
        return BusTicket::where('status', 'canceled')->count();
    }
}
