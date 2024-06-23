<?php

namespace App\Http\Controllers\Auth;

use DB;
use Hash;
use Exception;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Helpers\NotificationHelper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'exists:users,email', 'regex:/(.+)@(.+)\.(.+)/i'],
            'password'    => ['required']
        ], [
            'email.exists' => 'Invalid Email/Password'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            NotificationHelper::errorResponse('No user found!');
            return back();
        }

        if (!Hash::check($request->password, $user->password)) {
            NotificationHelper::errorResponse('Password is incorrect!');
            return back();
        }

        Auth::loginUsingId($user->id);
        NotificationHelper::successResponse('You are logged In!');
        return redirect()->route('user.dashboard');
    }

    public function register(UserRegisterRequest $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->date_of_birth = $request->date_of_birth;
                $user->password = Hash::make($request->password);
                $user->save();
                $role = Role::where('name', '=', 'user')->first();
                $user->assignRole($role);
            });
            NotificationHelper::successResponse('Account created successfully! Login to continue');
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            dd("Error occured -- " . $e->getMessage() . "--\n" . "-- Line number -- " . $e->getLine());
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function adminLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->hasRole(['superadmin'])) {
                NotificationHelper::errorResponse('User does not have required permission to login!');
                return back();
            }
            return redirect()->route('admin.dashboard');
        }
        return view('auth.backend.login');
    }

    public function adminLoginPost(AdminLoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();
        if (!$user->hasRole(['superadmin', 'admin'])) {
            NotificationHelper::errorResponse('User does not have required permission to login!');
            return back();
        }

        if (Auth::attempt($credentials)) {
            NotificationHelper::successResponse("Admin logged in successfully");
            return redirect()->route('admin.dashboard');
        }

        NotificationHelper::errorResponse('Invalid credentials!');
        return back()->withInput();
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
