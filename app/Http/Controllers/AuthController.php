<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $otp = random_int(100000, 999999);

        session([
            'otp' => $otp,
            'otp_email' => $request->email,
            'otp_expires_at' => now()->addMinutes(5)
        ]);


        cache()->put('otp_' . $request->email, $otp, now()->addMinutes(5));
        cache()->put('otp_expires_' . $request->email, now()->addMinutes(5), now()->addMinutes(5));

        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('OTP Verification');
        });

        return response()->json([
            'message' => 'OTP Sent Successfully'
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'otp' => 'required',
            'type' => 'required'
        ]);

        if (
            session('otp') != $request->otp ||
            session('otp_email') != $request->email ||
            now()->gt(session('otp_expires_at'))
        ) {
            return back()->with('error', 'Invalid or Expired OTP');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'otp' => session('otp'),
            'otp_expires_at' => session('otp_expires_at'),
            'is_approved' => $request->type == 'agent' ? 0 : 1
        ]);

        $user->assignRole($request->type);
        Auth::login($user);
        session()->forget(['otp', 'otp_email', 'otp_expires_at']);

        return redirect('/dashboard');
    }

    public function registerApi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|min:6',
            'otp' => 'required'
        ]);


        $cachedOtp = cache()->get('otp_' . $request->email);
        $cachedExpiry = cache()->get('otp_expires_' . $request->email);

        if (
            !$cachedOtp ||
            $cachedOtp != $request->otp ||
            now()->gt($cachedExpiry)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or Expired OTP'
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'otp' => $cachedOtp,
            'otp_expires_at' => $cachedExpiry,
            'is_approved' => 1
        ]);

        $user->assignRole('user');


        $token = $user->createToken('react-app')->plainTextToken;


        cache()->forget('otp_' . $request->email);
        cache()->forget('otp_expires_' . $request->email);

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->getRoleNames()->first(),
            ]
        ]);
    }


    public function loginApi(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }


        $token = $user->createToken('react-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->getRoleNames()->first(),
                'permissions' => $user->getAllPermissions()->pluck('name'),
            ]
        ]);
    }


    public function generateLoginToken(Request $request)
    {
        $userId = $request->user_id;
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $token = \Illuminate\Support\Str::random(64);

        cache()->put('auto_login_' . $token, $user->id, now()->addSeconds(30));

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }
}