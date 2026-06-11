<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();
        return view('user', compact('users'));
    }

    public function agents()
    {
        $users = User::role('agent')->latest()->get();
        return view('user', compact('users'));
    }
    public function updateStatus($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $user = User::findOrFail($id);


        $user->is_approved = !$user->is_approved;
        $user->save();


        if ($user->is_approved) {


            $user->assignRole('agent');

        } else {


            $user->syncRoles([]);
            $user->syncPermissions([]);
        }

        return back()->with('success', 'Status Updated');
    }
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone,' . $user->id,
            'is_approved' => 'nullable|boolean',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;

        $user->is_approved = $request->is_approved ? 1 : 0;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'User updated');
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('addUser', compact('roles'));
    }


    public function store(Request $request)
    {

        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|exists:roles,name'
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'otp' => session('otp'),
            'otp_expires_at' => session('otp_expires_at'),

        ]);


        $user->assignRole($request->role);

        return back()->with('success', 'User Created Successfully');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::findOrFail($request->id);

        if (!Hash::check($request->current_password, $user->password)) {

            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully'
        ]);
    }
}