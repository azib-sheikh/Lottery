<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Helpers\NotificationHelper;
use DB;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::withoutRole(['superadmin'])->get();
        return view('backend.users.index', compact('data'));
    }

    public function CreateUser()
    {
        return view('backend.users.create');
    }

    public function StoreUser(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'          => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'mobile'        => 'required|regex:/^[0-9]{10}$/|unique:users,mobile',
            'password'      => 'required|min:8',

        ]);

        if ($validator->fails()) {
            NotificationHelper::errorResponse($validator->errors()->first());
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->password = Hash::make($request->password);
                $user->save();
                $user->assignRole('admin');
            });
            NotificationHelper::successResponse('Account created successfully! Login to continue');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            dd("Error occured -- " . $e->getMessage() . "--\n" . "-- Line number -- " . $e->getLine());
        }
    }
}
