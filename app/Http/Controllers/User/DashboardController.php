<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }
}
