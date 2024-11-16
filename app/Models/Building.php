<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_name', 'owner_phone', 'pincode',];

    public function floors()
    {
        return $this->hasMany(Floor::class,'building_id');
    }

    public function rooms()
    {
        return $this->hasManyThrough(Room::class, Floor::class, 'building_id', 'floor_id');
    }
}
