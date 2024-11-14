<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'payment_date',
        'amount_paid',
        'due_amount',
        'due_date',
        'due_end_date',
        'description',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
