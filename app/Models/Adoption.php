<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['user_id', 'guinea_pig_id', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guineaPig()
    {
        return $this->belongsTo(GuineaPig::class);
    }
}
