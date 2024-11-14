<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'building_id',
        'room_id',
        'unit_type',
        'floor',
        'sharing_type',
        'daily_stay_charges_min',
        'daily_stay_charges_max',
        'is_room_available',
        'electricity_reading_last',
        'electricity_reading_date',
        'room_photos',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function stayDetails()
    {
        return $this->hasMany(StayDetail::class);
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
