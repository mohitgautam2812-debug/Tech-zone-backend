<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $ruqest){
        $user = auth()->user();

        if($user->hasRole('admin')){
            return view('dashboard');
        }
        if($user ->hasRole('agent')){
            return view('dashboard');
        }
        return view ('dashboard');
    }
}
