<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lottery = Lottery::first();
        // return $lottery->lotteryNumbers;
        return view('landing.home', compact('lottery'));
    }
}
