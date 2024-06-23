<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::withoutRole(['superadmin'])->get();
        return view('backend.users.index', compact('data'));
    }
}
