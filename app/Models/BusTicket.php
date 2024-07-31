<?php

namespace App\Models;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTicket extends Model
{
    use HasFactory;


    protected $append = ['qr_image', 'order_id'];

    protected $casts = [
        'departure_time' => 'datetime',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function busSchedule()
    {
        return $this->belongsTo(BusSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQrImageAttribute()
    {
        return "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".url('/my-tiket/'.$this->id.'/verify');
    }

    public function getQrAttribute()
    {
        return (new QRCode(new QROptions()))->render(url('/my-tiket/'.$this->id.'/verify'));
    }

    public function getOrderIdAttribute()
    {
        return sprintf("#ORD%04d", $this->id);
    }

    public function getIsExpiredAttribute()
    {
        return $this->departure_time->isPast();
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == 'canceled') 
        {
            return 'Dibatalkan';
        }
        
        if ($this->is_expired) {
            if ($this->status == 'pending') 
            {
                $this->update(['status' => 'rejected']);
            }
            else if($this->status == 'approved')
            {
                return 'Diberangkatkan';
            }
            return 'Kadaluwarsa';
        }
        if ($this->departure_time->format('Y-m-d') == now()->format('Y-m-d')) 
        {
            if ($this->status == 'pending') 
            {
                return 'Menunggu Keberangkatan';
            }
            if($this->status == 'approved')
            {
                return 'Diberangkatkan';
            }
            return 'Hari Ini';
        }
        return 'Belum Terdefinisi';
    
    }

    public function getStatusColorAttribute()
    {

        if ($this->status == 'canceled') {
            return 'red';
        }
        if ($this->departure_time->format('Y-m-d') == now()->format('Y-m-d')) {
            return 'green';
        }
        if ($this->departure_time->isTomorrow()) {
            return 'green';
        }
        if ($this->is_expired) {
            return 'gray';
        }
        if ($this->status == 'pending') {
            return 'orange';
        }
    }
}
