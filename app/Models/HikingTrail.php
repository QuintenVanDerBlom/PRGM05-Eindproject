<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HikingTrail extends Model
{
    // Define the fillable fields
    protected $fillable = ['name', 'location', 'type_trail', 'difficulty', 'created_by',];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_hiking_trail', 'hiking_trail_id', 'category_id');
    }
}
