<?php

namespace App\Http\Controllers\user;

use DB;
use Validator;
use App\Models\User;
use App\Models\PayoutDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AdditionalDetailsUser;
use App\Http\Helpers\NotificationHelper;
use App\Services\RazorpayService;

class ProfileController extends Controller
{

    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'profile_picture' => 'sometimes|mimes:png,jpg,jpeg|max:4096',
                'email' => [
                    'sometimes',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'pan' => 'sometimes|string|max:255|nullable',
                'account_number' => 'sometimes|string|max:255|nullable',
                'ifsc_code' => 'sometimes|string|max:11|nullable',
                'verification_document_type' => 'sometimes|string|max:255|nullable',
                'verificationDoc' => 'sometimes|mimes:pdf|max:10240|nullable'
            ]);

            if ($validator->fails()) {
                NotificationHelper::errorResponse($validator->errors()->first());
                return back()->withErrors($validator)->withInput();
            }

            DB::transaction(function () use ($request, $user) {
                if ($request->hasFile('profile_picture')) {
                    $profilePicture = $request->file('profile_picture');
                    $profilePictureName = time() . '_' . $profilePicture->getClientOriginalName();
                    $profilePicture->move(public_path('profile_pictures'), $profilePictureName);
                    $user->profile_picture = 'profile_pictures/' . $profilePictureName;
                }

                if ($request->filled('email')) {
                    $user->email = $request->email;
                }

                $additionalDetails = $user->additionalDetail ?? new AdditionalDetailsUser;

                if ($additionalDetails) {

                    $additionalDetails->user_id = $user->id;

                    if ($request->filled('pan')) {
                        $additionalDetails->pan_number = $request->pan;
                    }

                    if ($request->filled('account_number')) {
                        $additionalDetails->account_number = $request->account_number;
                    }

                    if ($request->filled('ifsc_code')) {
                        $additionalDetails->ifsc_code = $request->ifsc_code;
                    }

                    if ($request->filled('verification_document_type')) {
                        $additionalDetails->verification_document_type = $request->verification_document_type;
                    }

                    if ($request->hasFile('verificationDoc')) {
                        $verificationDoc = $request->file('verificationDoc');
                        $verificationDocName = time() . '_' . $verificationDoc->getClientOriginalName();
                        $verificationDoc->move(public_path('verification_documents'), $verificationDocName);
                        $additionalDetails->verification_document_path = 'verification_documents/' . $verificationDocName;
                    }

                    $additionalDetails->save();

                    // Create account for payout start


                    $payoutDetail = PayoutDetail::where('user_id', Auth::user()->id)->first();
                    if ($payoutDetail && $payoutDetail['contact_id']) {
                        $bank_data_for_payout = [

                            'contact_id' => $payoutDetail['contact_id'],
                            'account_holder_name' => $user->name,
                            'account_number' => $request->account_number,
                            "ifsc" => $request->ifsc_code,
                        ];
                        $resFundAcc = $this->createFundAccount($bank_data_for_payout);
                        if ($resFundAcc && $resFundAcc->status() == 200) {
                            $data = $resFundAcc->original;
                            // dd($data);
                            // dd($data['error']);
                            if (isset($data) && array_key_exists('error', $data) && $data['error']['code'] == 'BAD_REQUEST_ERROR') {
                                NotificationHelper::errorResponse($data['error']['description']);
                                return back();
                            } else {
                                $payoutDetail->fund_account_id = $data['id'];
                                $payoutDetail->save();
                            }
                        }
                    } else {
                        NotificationHelper::errorResponse('Razorpay Contact ID is not updated.');
                        return back();
                    }

                    // Create account for payout end

                }

                $user->save();
            });

            NotificationHelper::successResponse('Profile updated successfully.');
            return back();
        } catch (\Exception $e) {
            dd($e->getLine(), $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // 2. Create Fund Account API
    public function createFundAccount($bank_data_for_payout)
    {

        $request = (object) $bank_data_for_payout;
        $response = $this->razorpayService->createFundAccount(
            $request->contact_id,
            $request->account_holder_name,
            $request->account_number,
            $request->ifsc
        );

        return response()->json($response);
    }
}
