<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $checked_lottery_numbers = $request->input('lotteryNumbers');
            $lottery_id  = $request->input('lotteryId');
            $checked_winning_quantity = $request->input('checkedWinningNumber');

            $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('lottery_id', $lottery_id)->first();
            if ($already_cart) {
                $already_cart->checked_lottery_numbers = $checked_lottery_numbers;
                $already_cart->checked_winning_quantity = $checked_winning_quantity;
                $already_cart->save();
            } else {

                $Cart = new Cart();
                $Cart->user_id = $user->id;
                $Cart->lottery_id = $lottery_id;
                $Cart->checked_lottery_numbers = $checked_lottery_numbers;
                $Cart->checked_winning_quantity = $checked_winning_quantity;
                $Cart->save();
            }

            return response()->json(
                [
                    'cartStatus' => 'success',
                    'message' => 'Item added to cart'
                ]
            );
        } else {
            return response()->json(
                [
                    'cartStatus' => 'error',
                    'message' => 'Item added to cart'
                ]
            );
        }
    }
}
