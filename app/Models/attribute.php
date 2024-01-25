<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function roomAttributes()
    {
        return $this->hasmany(room_attributes::class);
    }
}
