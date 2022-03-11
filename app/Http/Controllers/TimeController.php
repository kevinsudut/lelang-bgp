<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function time()
    {
        return response()->json([
            'time' => Carbon::now(),
        ]);
    }
}
