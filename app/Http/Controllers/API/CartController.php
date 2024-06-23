<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $lotteryNumbers = $request->input('lotteryNumbers');

        // Add item to cart in session
        $cart = session('cart', []);
        $cart[] = $lotteryNumbers;
        session(['cart' => $cart]);

        return response()->json(['message' => 'Item added to cart']);
    }
}
