<?php

namespace App\Http\Controllers\Backend;

use DB;
use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Lottery;
use App\Models\LotteryNumber;
use Illuminate\Http\Request;
use App\Models\LotteryMaster;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Http\Requests\CreateLotteryRequest;
use Flasher\Prime\Notification\Notification;
use PHPUnit\Framework\TestStatus\Notice;

class LotteryController extends Controller
{
    public function lotteryMasterIndex()
    {
        $data = LotteryMaster::latest()->get();
        return view('backend.lotteryMaster.index', compact('data'));
    }

    /**
     * Inserts a new lottery into master
     */
    public function lotteryMasterCreate()
    {
        return view('backend.lotteryMaster.create');
    }

    public function lotteryMasterStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lottery_name' => 'sometimes|string|max:255|required',
                'lottery_price' => 'sometimes|integer|required',
                'lottery_type' => 'sometimes|required',
                'lottery_winning_amount' => 'sometimes|required',
                'lottery_image' => 'mimes:png,jpg,jpeg|max:4096|required',

            ]);
            if ($validator->fails()) {
                NotificationHelper::errorResponse($validator->errors()->first());
                return back()->withErrors($validator)->withInput();
            }
            DB::transaction(function () use ($request) {
                $lotteryMaster = new LotteryMaster();

                if ($request->hasFile('lottery_image')) {
                    $lottery_image = $request->file('lottery_image');
                    $lotteryImageName = time() . '_' . $lottery_image->getClientOriginalName();
                    $lottery_image->move(public_path('lottery_image'), $lotteryImageName);
                    $lotteryMaster->lottery_image = 'lottery_image/' . $lotteryImageName;
                }
                $lotteryMaster->lottery_name = $request->lottery_name;
                $lotteryMaster->lottery_price = $request->lottery_price;
                $lotteryMaster->lottery_type = $request->lottery_type;
                $lotteryMaster->lottery_winning_amount = $request->lottery_winning_amount;
                $lotteryMaster->description = $request->description;
                $lotteryMaster->save();
            });

            NotificationHelper::successResponse("Lottery Master Created!");
            return redirect()->route('admin.lotteryMaster.index');
        } catch (Exception $e) {
            NotificationHelper::errorResponse($e->getMessage());
            return back();
        }
    }


    public function lotteryIndex()
    {
        $data = Lottery::latest()->get();
        return view('backend.lottery.index', compact('data'));
    }

    public function lotteryCreate()
    {
        $lotteryMaster = LotteryMaster::whereDoesntHave('lottery')->latest()->get();
        return view('backend.lottery.create', compact('lotteryMaster'));
    }

    public function lotteryStore(CreateLotteryRequest $request)
    {
        try {

            DB::transaction(function ()  use ($request) {
                $lottery = Lottery::create([
                    'lottery_master_id' => $request->lottery_master_id,
                    'expires_on' => \Carbon\Carbon::parse($request->expires_on)->format('Y-m-d H:i'),
                ]);

                $numbers = range($request->start_number, $request->end_number);

                foreach ($numbers as $number) {
                    LotteryNumber::create([
                        'lottery_master_id' => $request->lottery_master_id,
                        'lottery_id' => $lottery->id,
                        'number' => $number,
                    ]);
                }
            });


            NotificationHelper::successResponse("Lottery Created succesfully");
            return redirect()->route('admin.lottery.index');
        } catch (Exception $e) {
            dd($e->getLine(), $e->getMessage());
        }
    }

    public function lotteryEdit(Request $request)
    {

        if (!$request->query('lottery_id')) {
            NotificationHelper::errorResponse("Malformed Url!");
            return redirect()->route('admin.lottery.index');
        }

        $lottery = Lottery::find($request->query('lottery_id'));
        // dd($lottery->lotteryMaster->lottery_name);
        if (!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }

        return view('backend.lottery.edit', compact('lottery'));
    }

    public function lotteryUpdate(Request $request)
    {


        if (!$request->lottery_id) {
            NotificationHelper::errorResponse("Malformed Url!");
            return redirect()->route('admin.lottery.index');
        }

        $lottery = Lottery::find($request->lottery_id);
        // dd($lottery->lotteryMaster->lottery_name);
        if (!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }

        $lottery->winning_number = $request->winning_number;
        $lottery->save();
        NotificationHelper::successResponse("Lottery Updated succesfully");
        return redirect()->route('admin.lottery.index');
    }



    public function lotteryShow(Request $request)
    {
        if (!$request->query('lottery_id')) {
            NotificationHelper::errorResponse("Malformed Url!");
            return redirect()->route('admin.lottery.index');
        }

        $lottery = Lottery::find($request->query('lottery_id'));
        if (!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }

        $cartItemByLotteryId = Cart::where('lottery_id', $request->query('lottery_id'))->get();
        // dd($cartItemByLotteryId);
        $numberCounts = []; // To store the frequency of each number

        // Loop through each record
        foreach ($cartItemByLotteryId as $record) {
            // Convert the string of lottery numbers into an array of integers
            $numbers = array_map('intval', explode(',', $record['checked_lottery_numbers']));

            // Count the occurrences of each number
            foreach ($numbers as $number) {
                if (isset($numberCounts[$number])) {
                    $numberCounts[$number]++;
                } else {
                    $numberCounts[$number] = 1;
                }
            }
        }
        // dd($numberCounts);
        // // Display the frequency of each number
        // foreach ($numberCounts as $number => $count) {
        //     echo "Number " . $number . " is selected " . $count . " times.\n";
        // }

        return view('backend.lottery.show', compact('lottery', 'numberCounts'));
    }

    public function lotteryShowChosenNumbers($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        if (!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }

        $cartItemByLotteryId = Cart::where('lottery_id', $lotteryId)->get();
        // dd($cartItemByLotteryId);
        // $numberCounts = []; // To store the frequency of each number

        // Loop through each record
        // foreach ($cartItemByLotteryId as $record) {
        //     // Convert the string of lottery numbers into an array of integers
        //     $numbers = array_map('intval', explode(',', $record['checked_lottery_numbers']));

        //     // Count the occurrences of each number
        //     foreach ($numbers as $number) {
        //         if (isset($numberCounts[$number])) {
        //             $numberCounts[$number]++;
        //         } else {
        //             $numberCounts[$number] = 1;
        //         }
        //     }
        // }

        // dd($numberCounts);
        // $chosenNumbers = DB::table('user_chosen_numbers')
        //     ->join('users', 'users.id', '=', 'user_chosen_numbers.user_id')
        //     ->select('user_chosen_numbers.*', 'users.name')
        //     ->get();
        return view('backend.lottery.showChosenNumbers', compact('lottery', 'cartItemByLotteryId'));
    }
}
