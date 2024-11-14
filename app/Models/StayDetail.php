<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StayDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'stay_start_date',
        'stay_end_date',
        'tenant_id',
        'stay_start_date',
        'stay_end_date',
        'move_in_date',
        'move_out_date',
        'lock_in_period',
        'notice_period',
        'agreement_period',
        'rental_frequency',
        'electricity_meter_details',
        'remark',
        'regular_security_deposit',
        'fixed_rent',
        'add_rent_on'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
