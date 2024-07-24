<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\NotificationHelper;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\NotificationHelper;



class TransactionController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        // $user = User::with(['user_transactions' => function ($q) {
        //     $q->orderBy('id', 'desc')->paginate(3);
        // }])->find($user_id);
        $user_transactions = Transaction::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(3);
        return view('user.transaction.index', compact('user_transactions'));

        // return view('user.transaction.index');
    }

    public function index_load_more(Request $request)
    {
        $user_id = Auth::user()->id;

        // Define the number of items to load per request
        $itemsPerPage = 3;

        // Retrieve the current page from the request, default to 1
        $page = $request->input('page', 1);

        // Retrieve the items for the current page
        $user_transactions = Transaction::where('user_id', $user_id)->orderBy('id', 'desc')->paginate($itemsPerPage, ['*'], 'page', $page);

        // Check if there are more pages
        $hasMorePages = $user_transactions->hasMorePages();

        // Return a JSON response with the items and the flag indicating if more pages exist
        $more_data =  view('user.transaction.index-load-more', compact('user_transactions'))->render();
        return response()->json([
            'user_transactions' => $more_data,
            'hasMorePages' => $hasMorePages
        ]);
        // return view('user.transaction.index-load-more', compact('user_transactions'))->render();

    }

    public function show()
    {
        return view('user.transaction.show');
    }

    public function wallet()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['user_transactions' => function ($q) {
            $q->limit('5')->orderBy('id', 'desc');
        }])->find($user_id);
        // dd($user);
        return view('user.wallet.index', compact('user'));
    }

    public function depositAmount(Request $request)
    {
        $user = auth()->user();
        $amount = $request->deposit_amount;
        $payment_reference_number = $request->payment_reference_number;



        if ($request->hasFile('payment_image')) {
            $payment_image = $request->file('payment_image');
            $payment_imageName = time() . '_' . $payment_image->getClientOriginalName();
            $payment_image->move(public_path('payment_image'), $payment_imageName);
            $payment_image = 'payment_image/' . $payment_imageName;
        }
        Transaction::create([
            'user_id' => $user->id,
            'amount' =>  $amount,
            'mode_of_payment' => '1',
            'payment_reference_number' => $payment_reference_number,
            'action' => '1',
            'status' => '3',
            'payment_image' => $payment_image,
        ]);


        NotificationHelper::successResponse('Amount deposit successfully.');
        return redirect()->route('user.wallet.show-wallet');
    }

    public function withdrawAmount(Request $request)
    {
        $user = auth()->user();
        $amount = $request->withdraw_amount;

        if ($user['walletBalance'] < $amount) {
            NotificationHelper::errorResponse('Insufficient wallet balance.');
            return redirect()->route('user.wallet.show-wallet');
        }

        $leftBalance = $user['walletBalance'] - $amount;
        Transaction::create([
            'user_id' => $user->id,
            'amount' =>  $amount,
            'mode_of_payment' => '0',
            'payment_reference_number' => '',
            'action' => '2',
            'status' => '3',
        ]);

        User::where('id', auth()->user()->id)->update(['walletBalance' => $leftBalance]);
        NotificationHelper::successResponse('Amount  withdraw successfully.');
        return redirect()->route('user.wallet.show-wallet');
    }
}
