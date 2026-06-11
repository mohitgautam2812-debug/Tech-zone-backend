<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{

    // SHOW FORM
    public function index()
    {
        $setting = Setting::first();

        return view(
            'footer',
            compact('setting')
        );
    }

    // STORE / UPDATE
    public function store(Request $request)
    {

        $setting = Setting::first();

        if (!$setting) {

            Setting::create([

                'site_name' => $request->site_name,

                'footer_description' =>
                    $request->footer_description,

                'facebook' => $request->facebook,

                'twitter' => $request->twitter,

                'instagram' => $request->instagram,

                'youtube' => $request->youtube,

                'address' => $request->address,

                'phone' => $request->phone,

                'email' => $request->email,

                'copyright' => $request->copyright,

            ]);

        } else {

            $setting->update([

                'site_name' => $request->site_name,

                'footer_description' =>
                    $request->footer_description,

                'facebook' => $request->facebook,

                'twitter' => $request->twitter,

                'instagram' => $request->instagram,

                'youtube' => $request->youtube,

                'address' => $request->address,

                'phone' => $request->phone,

                'email' => $request->email,

                'copyright' => $request->copyright,

            ]);

        }

        return back()->with(
            'success',
            'Footer Settings Updated'
        );
    }

    // API
    public function footer()
    {
        return Setting::first();
    }
}