<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'name',
        'total_rooms',
        'floor_number'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }
}
