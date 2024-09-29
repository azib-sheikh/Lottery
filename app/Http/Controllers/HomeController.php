<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $todaydate = date('Y-m-d h:i:00');

        $lottery = Lottery::where('expires_on', '>=', $todaydate)->get();
        // dd($lottery->isEmpty());
        // return $lottery->lotteryNumbers;
        return view('landing.home', compact('lottery'));
    }
    public function lottery_details_ajax(Request $request)
    {
        // dd($request->all());
        $lottery_id = $request->lottery_id;
        $lottery = Lottery::where('id', '=', $lottery_id)->first();

        if ($lottery->lotteryMaster->lottery_type == 2) {
            $lottery_type = 'checkbox';
            $selectedNumber = 'selectedNumber[]';
        } else {
            $lottery_type = 'radio';
            $selectedNumber = 'selectedNumber';
        }

        $lotteryNumbers = $lottery->lotteryNumbers;
        $lotteryNumbersArray = [];
        foreach ($lotteryNumbers as $item) {
            $lotteryItems = "<input type= '$lottery_type' name='$selectedNumber' value='$item->number' class='single-number lotteryNumbers' id='lot_no_$item->number' hidden><label for='lot_no_$item->number'>$item->number</label>";

            $lotteryNumbersArray[] = $lotteryItems;
        }

        $lotteryWinningAmount = $lottery->lotteryMaster->lottery_winning_amount;
        $lotteryWinningAmountArray = [];
        for ($i = 1; $i <= $lotteryWinningAmount; $i++) {
            $lotteryWinningItems = "<input type='radio' name='lotteryWinningItems' value='$i' class='winning-number' id='s_lot_no_$i' hidden><label for='s_lot_no_$i'>X$i</label>";
            $lotteryWinningAmountArray[] = $lotteryWinningItems;
        }
        $lottery_image = is_null($lottery->lotteryMaster->lottery_image) || empty($lottery->lotteryMaster->lottery_image)
            ? asset('profile.png')
            : asset($lottery->lotteryMaster->lottery_image);

        $expires_on = Carbon::parse($lottery->expires_on)->format('d-m-Y g:i A');

        $data = [];
        $data['lottery_name'] = $lottery->lotteryMaster->lottery_name;
        $data['lottery_price'] = $lottery->lotteryMaster->lottery_price;
        $data['lottery_type'] = $lottery->lotteryMaster->lottery_type;
        $data['lottery_winning_amount'] = $lottery->lotteryMaster->lottery_winning_amount;
        $data['lottery_image'] = $lottery_image;
        $data['lotteryNumbersArray'] = $lotteryNumbersArray;
        $data['expires_on'] = $expires_on;
        $data['expires_on_timer'] = $lottery->expires_on;
        $data['lotteryWinningAmountArray'] = $lotteryWinningAmountArray;
        return $data;
        // dd($data);
    }
}
