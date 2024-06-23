<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{


    function __construct()
    {
        // $this->middleware(['role:superadmin']);
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }
}
