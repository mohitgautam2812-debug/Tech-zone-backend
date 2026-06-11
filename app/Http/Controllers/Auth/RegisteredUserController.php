<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|confirmed|min:6',

            'type' => 'required',
            'otp' => 'required'
        ]);


        if (
            session('otp') != $request->otp ||
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
            'is_approved' => $request->type === 'agent' ? 0 : 1,
        ]);

        $user->assignRole($request->type);

        Auth::login($user);

        session()->forget(['otp', 'otp_expires_at']);

        return redirect('/dashboard');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $user = auth()->user();

        if (
            $user &&
            $user->otp == $request->otp &&
            $user->otp_expires_at &&
            now()->lt($user->otp_expires_at)
        ) {
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = Carbon::now();
            $user->save();

            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid or expired OTP');
    }
}