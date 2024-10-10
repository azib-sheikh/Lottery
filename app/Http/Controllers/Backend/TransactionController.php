<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\PayoutDetail;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use App\Services\RazorpayService;
use App\Http\Helpers\NotificationHelper;

class TransactionController extends Controller
{

    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

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
        $amount = (int)$transaction['amount'];
        // dd(gettype($amount));
        $user = User::find($transaction['user_id']);
        $status = $request->status;
        $rzp_payment_error_response = '';
        $rzpStatus = '';
        $account_number_from_where_amount_deduct = '2323230002395517';
        $payment_reference_number = $transaction['payment_reference_number'];
        $mode_of_payment = $transaction['mode_of_payment'];

        // action => 1=deposit, 2=withdrawal, 3=lottery buying,
        //status => 1=approved,2=reject,3=pending,,4=fail
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
                // $transactionStatus = '1';

                // Create payout start

                $payoutDetail = PayoutDetail::where('user_id', $user['id'])->first();

                if ($payoutDetail && $payoutDetail['contact_id'] && $payoutDetail['fund_account_id']) {
                    $data_for_payout = [

                        'fund_account_id' => $payoutDetail['fund_account_id'],
                        "amount" => $amount,
                        'currency' => 'INR',
                        "mode" => 'IMPS',
                        "account_number" => $account_number_from_where_amount_deduct,
                    ];
                    $resPayout = $this->createPayout($data_for_payout);
                    // dd($resPayout);
                    if ($resPayout && $resPayout->status() == 200) {
                        $data = $resPayout->original;
                        // dd($data);
                        // dd($data['error']);
                        if (isset($data) && array_key_exists('error', $data) && $data['error']['code'] == 'BAD_REQUEST_ERROR') {
                            $rzp_payment_error_response = $data['error']['description'];
                            NotificationHelper::errorResponse($data['error']['description']);
                            return back();
                        } else {
                            $rzpStatus = $data['status'];
                            $payment_reference_number = $data['id']; // Payout id like pout_PXXXXX
                            $transactionStatus = '1';
                            // if ($status == 'processing') {
                            //     $resapprovPayout = $this->approvePayout($payment_reference_number);
                            //     $transactionStatus = '3';
                            // }
                            $mode_of_payment = '4';
                        }
                    }
                } else {
                    NotificationHelper::errorResponse('Razorpay Fund Account ID is not updated.');
                    return back();
                }

                // Create  payout end

            } elseif ($status == 'reject') {
                $userWallet = $user['walletBalance'] + $amount;
                $transactionStatus = '2';
            }
        }

        $updatUserData['walletBalance'] =  $userWallet;
        User::where('id', $user['id'])->update($updatUserData);

        $updatUserTransaction['status'] =  $transactionStatus;
        $updatUserTransaction['rzp_payment_error_response'] =  $rzp_payment_error_response;
        $updatUserTransaction['account_number'] =  $account_number_from_where_amount_deduct;
        $updatUserTransaction['payment_reference_number'] =  $payment_reference_number;
        $updatUserTransaction['mode_of_payment'] =  $mode_of_payment;
        $updatUserTransaction['rzp_status'] =  $rzpStatus;
        Transaction::where('id', $transactions_id)->update($updatUserTransaction);
    }

    // 3. Create Payout API
    public function createPayout($data_for_payout)
    {
        $request = (object) $data_for_payout;

        $response = $this->razorpayService->createPayout(
            $request->account_number,
            $request->fund_account_id,
            $request->amount,
            $request->currency ?? 'INR',
            $request->mode ?? 'IMPS'
        );

        return response()->json($response);
    }
}
