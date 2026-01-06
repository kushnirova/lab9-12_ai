<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuineaPig extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['name', 'age', 'category_id', 'description', 'status', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
