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

            $referred_by = '';
            if ($request->referred_by) {
                $user = User::where('referral_code', $request->referred_by)->first();

                if (is_null($user)) {
                    NotificationHelper::errorResponse('Invalid referrel code.');
                    return redirect()->route('auth.register');
                }
                $referred_by = $user['id'];
            }
            $referral_code = $this->generateUniqueCode();
            DB::transaction(function () use ($request, $referral_code, $referred_by) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                // $user->date_of_birth = $request->date_of_birth;
                $user->referral_code = $referral_code;
                $user->referred_by = $referred_by;
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

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (User::where('referral_code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }
}
