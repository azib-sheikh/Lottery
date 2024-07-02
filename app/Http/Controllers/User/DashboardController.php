<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\CartHelper;
use App\Models\Cart;
use App\Models\Lottery;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    public function check_helper_function()
    {
        // dd(CartHelper::totalCartPrice());
        $user_id = '';
        if ($user_id == "") $user_id = auth()->user()->id;
        $cart = Cart::where('user_id', $user_id)->where('order_id', null)->get();
        $total_price = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $lottery = Lottery::where('id', $item['lottery_id'])->first();

                $lottery_price = $lottery->lotteryMaster->lottery_price;
                $checked_winning_quantity = $item['checked_winning_quantity'];
                $checked_lottery_numbers = $item['checked_lottery_numbers'];
                $checked_lottery_numbers_length = count(explode(',', $checked_lottery_numbers));
                $total_price += $checked_lottery_numbers_length * $checked_winning_quantity * $lottery_price;
            }
            dd($total_price);
            dd($lottery_price, $checked_winning_quantity, $checked_lottery_numbers, $checked_lottery_numbers_length, $total_price);
        }
    }
}
