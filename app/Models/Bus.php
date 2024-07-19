<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;


    public function busSchedules()
    {
        return $this->belongsToMany(BusSchedule::class);
    }

    public function busTicket()
    {
        return $this->hasMany(BusTicket::class);
    }

    public function getUsedSeat($date, $scheduleId) : array
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        return $this->busTicket()->whereIn('status', ['pending', 'approved'])->whereDate('departure_time', $date)->where('bus_schedule_id',$scheduleId)->get()->pluck('seat_number')->toArray();
    }

    public function getSeats($date, $scheduleId)
    {
        $usedSeats = $this->getUsedSeat($date, $scheduleId);
        return [
            'all' => range(1, $this->capacity),
            'used' => $usedSeats,
            'available' => array_diff(range(1, $this->capacity), $usedSeats)
        ];
    }
}
