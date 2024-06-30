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
        $user = Auth::user();
        if ($user) {
            $lotteryNumbers = $request->input('lotteryNumbers');
            $lotteryId = $request->input('lotteryId');
            $checkedWinningNumber = $request->input('checkedWinningNumber');

            $Cart = new Cart();


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
