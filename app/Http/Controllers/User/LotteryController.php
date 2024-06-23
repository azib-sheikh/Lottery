<?php

namespace App\Http\Controllers\User;

use DB;
use Str;
use Exception;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\UserChosenNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\NotificationHelper;
use App\Models\Order;
use App\Models\Transaction;

class LotteryController extends Controller
{
    public function index()
    {
        $data = Lottery::all();
        return view('user.lottery.index', compact('data'));
    }

    public function chooseNumbers($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        if(!$lottery) {
            NotificationHelper::errorResponse("Invalid Lottery!");
            return back();
        }

        $selectedNumbers = UserChosenNumber::where('user_id',Auth::user()->id)
                            ->where('lottery_id', $lottery->id)->pluck('number')->toArray();

        return view('user.lottery.chooseNumbers', compact('lottery','selectedNumbers'));

    }


    public function checkout(Request $request)
    {
        // $encryptedLotteryNumbers = [];
        // foreach($request->numbers as $number) {
        //     $encryptedLotteryNumbers[] = encrypt($number);
        // }
        if(empty($request->numbers)) {
            NotificationHelper::errorResponse('Please select any number');
            return back();
        }
        $lottery = Lottery::find($request->lotteryId);
        $selectedNumbers = $request->numbers;

        return view('user.lottery.checkout', compact('lottery','selectedNumbers'));
    }


    public function saveChosenNumbers(Request $request)
    {
        if(empty($request->numbers)) {
            NotificationHelper::errorResponse('Please select any number');
            return back();
        }

        try {
            DB::transaction(function () use ($request) {
                $user = auth()->user(); 
                $selectedNumbers = $request->input('numbers');

                // create order
                $order = Order::create([
                    'user_id' => $user->id,
                    'lottery_id' => $request->lotteryId,
                    'numbers' => json_encode($request->input('numbers'))
                ]);


                // Save transaction
                Transaction::create([
                    'order_id' => $order->id,
                    'payment_status' => 'success',
                    'payment_amount' => 200,
                    'payment_mode' => 'Online',
                    'payment_reference_number' => Str::random(10),
                    'user_id' => $user->id
                ]);

                // Save selected numbers to database
                foreach ($selectedNumbers as $number) {
                    UserChosenNumber::create([
                        'user_id' => $user->id,
                        'number' => $number,
                        'lottery_id' => $request->lotteryId,
                        'lottery_master_id' => $request->lotteryMasterId
                    ]);
                }
            });


            NotificationHelper::successResponse('Number selected successfully');
            return redirect()->route('user.lottery.index');

        } catch(Exception $e) {
            dd($e->getLine(), $e->getMessage());
        }
    }


    public function showChosenNumbers($lotteryId)
    {
        $chosenNumbers = UserChosenNumber::where('user_id', Auth::user()->id)
                                    ->where('lottery_id', $lotteryId)
                                    ->get();
        if(count($chosenNumbers) == 0) {
            NotificationHelper::errorResponse('No numbers chosen yet!');
            return back();
        }

        return view('user.lottery.showChosenNumbers', compact('chosenNumbers'));


    }

}
