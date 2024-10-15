<?php

namespace App\Http\Controllers;

use App\Models\HikingTrail;


class HikingTrailController extends Controller
{
    public function index() {
        $trails = HikingTrail::all();

        return view('home', ['trails' => $trails]);
    }
}
