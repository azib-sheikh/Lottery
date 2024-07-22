<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationHelper;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{

    public function index()
    {
        // $data = Transaction::where('user_id', Auth::user()->id)->get();
        return view('user.transaction.index');
    }

    public function show()
    {
        return view('user.transaction.show');
    }
}
