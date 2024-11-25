<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['floor_id', 'capacity', 'price', 'availability', 'unit_type', 'sharing_type'];

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }
}
