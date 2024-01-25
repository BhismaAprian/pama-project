<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function roomAttributes()
    {
        return $this->hasMany(room_attributes::class);
    }

    public function roomReservation()
    {
        return $this->hasMany(RoomReservation::class);
    }
}
