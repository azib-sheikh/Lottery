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
use App\Models\Cart;
use App\Models\Transaction;
use App\Http\Helpers\CartHelper;
use App\Models\User;

class LotteryController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $data = Cart::where('user_id', $user->id)->where('order_id', '!=', null)->get();
            return view('user.lottery.index', compact('data'));
        } catch (Exception $e) {
            NotificationHelper::errorResponse($e->getLine(), $e->getMessage());
        }
    }

    public function chooseNumbers($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        if (!$lottery) {
            NotificationHelper::errorResponse("Invalid Lottery!");
            return back();
        }

        $selectedNumbers = UserChosenNumber::where('user_id', Auth::user()->id)
            ->where('lottery_id', $lottery->id)->pluck('number')->toArray();

        return view('user.lottery.chooseNumbers', compact('lottery', 'selectedNumbers'));
    }


    // public function checkout(Request $request)
    // {
    //     // $encryptedLotteryNumbers = [];
    //     // foreach($request->numbers as $number) {
    //     //     $encryptedLotteryNumbers[] = encrypt($number);
    //     // }
    //     if(empty($request->numbers)) {
    //         NotificationHelper::errorResponse('Please select any number');
    //         return back();
    //     }
    //     $lottery = Lottery::find($request->lotteryId);
    //     $selectedNumbers = $request->numbers;

    //     return view('user.lottery.checkout', compact('lottery','selectedNumbers'));
    // }

    public function checkout()
    {
        $cart_count = CartHelper::cartCount();

        if (empty($cart_count) or $cart_count == 0) {
            NotificationHelper::errorResponse('Cart is empty !');
            return redirect()->route('home');
        }

        return view('user.lottery.checkout');
    }

    public function processCheckout()
    {
        try {
            $user = Auth::user();
            $cartCount = CartHelper::cartCount();
            if (empty($cartCount)) {
                NotificationHelper::errorResponse('Cart is Empty !.');
                return redirect()->route('home');
            }
            $getAllProductFromCart = CartHelper::getAllProductFromCart();
            foreach ($getAllProductFromCart as $product) {
                $lottery = Lottery::where('id', $product['lottery_id'])->first();
                $todaydate = date('Y-m-d h:i:00');
                if ($product['expires_on'] < $todaydate) {
                    NotificationHelper::errorResponse($lottery->lotteryMaster->lottery_name . ' Lottery expired, Please remove from cart.');
                    return back();
                }
            }

            $totalCartPrice = CartHelper::totalCartPrice();

            if ($user['walletBalance'] < $totalCartPrice) {
                NotificationHelper::errorResponse('Insufficient wallet balance.');
                return back();
            }

            $order = new Order();
            $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
            $order_data['user_id'] = $user->id;
            $order_data['sub_total'] = $totalCartPrice;
            $order_data['quantity'] = $cartCount;
            $order_data['total_amount'] = $totalCartPrice;
            $order_data['payment_method'] = 'wallet';
            $order_data['payment_status'] = 'paid';
            $order_data['shipping_id'] = 0;
            $lfldlf =  $order->fill($order_data);
            $status = $order->save();
            $leftBalance = $user['walletBalance'] - $totalCartPrice;
            User::where('id', auth()->user()->id)->update(['walletBalance' => $leftBalance]);
            Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

            // Save transaction
            Transaction::create([
                'user_id' => $user->id,
                'amount' =>  $totalCartPrice,
                'mode_of_payment' => '3',
                'payment_reference_number' => $order->id,
                'action' => '3',
                'status' => '1',
            ]);

            NotificationHelper::successResponse('Lottery purchased successfully.');
            return redirect()->route('user.dashboard');
        } catch (Exception $e) {
            NotificationHelper::errorResponse($e->getLine(), $e->getMessage());
            // dd($e->getLine(), $e->getMessage());
        }
    }


    public function saveChosenNumbers(Request $request)
    {
        if (empty($request->numbers)) {
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
        } catch (Exception $e) {
            dd($e->getLine(), $e->getMessage());
        }
    }


    public function showChosenNumbers($lotteryId)
    {
        $chosenNumbers = UserChosenNumber::where('user_id', Auth::user()->id)
            ->where('lottery_id', $lotteryId)
            ->get();
        if (count($chosenNumbers) == 0) {
            NotificationHelper::errorResponse('No numbers chosen yet!');
            return back();
        }

        return view('user.lottery.showChosenNumbers', compact('chosenNumbers'));
    }

    public function removeCartItem(Request $request)
    {
        $cart_id = $request->id;
        Cart::where('id', $cart_id)->delete();
        NotificationHelper::successResponse('Lottery removed successfully.');
        $cart_count = CartHelper::cartCount();
        if (empty($cart_count) or $cart_count == 0) {
            return redirect()->route('home');
        } else {
            return back();
        }
    }

    public function showResult($lotteryId)
    {
        try {
            $user = Auth::user();
            $data = Cart::where('user_id', $user->id)->where('lottery_id', $lotteryId)->where('order_id', '!=', null)->first();
            $lottery = Lottery::find($lotteryId);

            $winning_number = explode(',', $lottery['winning_number']);
            $checked_lottery_numbers = explode(',', $data['checked_lottery_numbers']);

            $equalNumbers = array_intersect($winning_number, $checked_lottery_numbers);
            // dd($checked_lottery_numbers, $winning_number, $equalNumbers);
            return view('user.lottery.lotteryresult', compact('equalNumbers', 'winning_number'));
        } catch (Exception $e) {
            NotificationHelper::errorResponse($e->getLine(), $e->getMessage());
        }
    }
}
