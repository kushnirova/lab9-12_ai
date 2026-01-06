<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['user_id', 'guinea_pig_name', 'start_date', 'end_date', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
