<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HikingTrail extends Model
{
    use HasFactory;

    public function index() {

    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
