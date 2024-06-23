<?php

namespace App\Http\Controllers\Backend;

use DB;
use Exception;
use Validator;
use Carbon\Carbon;
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
        $data = LotteryMaster::all();
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
            DB::transaction(function () use ($request) {
                $lotteryMaster = new LotteryMaster();
                $lotteryMaster->lottery_name = $request->lottery_name;
                $lotteryMaster->description = $request->description;
                $lotteryMaster->save();
            });

            NotificationHelper::successResponse("Lottery Master Created!");
            return redirect()->route('adminlotteryMaster.index');
        } catch (Exception $e) {
            NotificationHelper::errorResponse("Some error occured!");
            return back();
        }
    }


    public function lotteryindex()
    {
        $data = Lottery::all();
        return view('backend.lottery.index', compact('data'));
    }

    public function lotteryCreate()
    {
        $lotteryMaster = LotteryMaster::all();
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
            dd($e->getLine(),$e->getMessage());
        }
    }


    public function lotteryShow(Request $request)
    {
        if(!$request->query('lottery_id')) {
            NotificationHelper::errorResponse("Malformed Url!");
            return redirect()->route('admin.lottery.index');
        }

        $lottery = Lottery::find($request->query('lottery_id'));
        if(!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }

        return view('backend.lottery.show', compact('lottery'));

    }

    public function lotteryShowChosenNumbers($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        if(!$lottery) {
            NotificationHelper::errorResponse("Lottery not found!");
            return redirect()->route('admin.lottery.index');
        }
        $chosenNumbers = DB::table('user_chosen_numbers')
                            ->join('users','users.id','=','user_chosen_numbers.user_id')
                            ->select('user_chosen_numbers.*','users.name')
                            ->get();
        return view('backend.lottery.showChosenNumbers', compact('lottery','chosenNumbers'));
    }

}
