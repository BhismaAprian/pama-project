<?php

namespace App\Models;

use App\Models\attribute as ModelsAttribute;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationAttributes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function roomReservation()
    {
        return $this->belongsTo(RoomReservation::class);
    }


    public function attributes()
    {
        return $this->belongsTo(ModelsAttribute::class);
    }
}
