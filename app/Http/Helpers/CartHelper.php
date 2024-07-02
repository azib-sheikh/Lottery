<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Lottery;

class CartHelper
{
    // Cart Count
    public static function cartCount($user_id = '')
    {

        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('checked_winning_quantity');
        } else {
            return 0;
        }
    }

    public static function getAllProductFromCart($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->get();
        } else {
            return 0;
        }
    }

    // Total amount cart
    public static function totalCartPrice($user_id = '')
    {
        if (Auth::check()) {
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
                return $total_price;
            }
        } else {
            return 0;
        }
    }
}
