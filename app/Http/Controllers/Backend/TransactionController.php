<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class TransactionController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_transactions = Transaction::with(['user' => function ($q) {
            $q->withoutRole(['superadmin']);
        }])->orderBy('id', 'desc')->get();
        // dd($user_transactions);
        return view('backend.transaction.index', compact('user_transactions'));

        // return view('user.transaction.index');
    }

    public function updateTransactionStatus(Request $request)
    {
        $transactions_id = $request->transactions_id;
        $transaction = Transaction::find($transactions_id);
        $amount = $transaction['amount'];
        $user = User::find($transaction['user_id']);
        $status = $request->status;

        // action => 1=deposit, 2=withdrawal, 3=lottery buying,
        //status => 1=approved,2=reject,3=pending
        if ($transaction['action'] == 1) {


            if ($status == 'accept') {
                $userWallet = $user['walletBalance'] + $amount;
                $transactionStatus = '1';
            } elseif ($status == 'reject') {
                $userWallet = $user['walletBalance'];
                $transactionStatus = '2';
            }
        } elseif ($transaction['action'] == 2) {

            if ($status == 'accept') {
                $userWallet = $user['walletBalance'];
                $transactionStatus = '1';
            } elseif ($status == 'reject') {
                $userWallet = $user['walletBalance'] + $amount;
                $transactionStatus = '2';
            }
        }

        $updatUserData['walletBalance'] =  $userWallet;
        User::where('id', $user['id'])->update($updatUserData);

        $updatUserTransaction['status'] =  $transactionStatus;
        Transaction::where('id', $transactions_id)->update($updatUserTransaction);
    }
}
