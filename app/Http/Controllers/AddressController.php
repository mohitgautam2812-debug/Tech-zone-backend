<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
   
    public function index($userId)
    {
        $addresses = Address::where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json($addresses);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $count = Address::where(
            'user_id',
            $request->user_id
        )->count();

        if ($count >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum 3 addresses allowed'
            ], 422);
        }

        $isDefault = $count == 0;

        $address = Address::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'is_default' => $isDefault
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address Added',
            'address' => $address
        ]);
    }


    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address Updated'
        ]);
    }

   
    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        $count = Address::where(
            'user_id',
            $address->user_id
        )->count();

        if ($count <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'At least one address required'
            ], 422);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address Deleted'
        ]);
    }

  
    public function setDefault($id)
    {
        $address = Address::findOrFail($id);

        Address::where(
            'user_id',
            $address->user_id
        )->update([
                    'is_default' => false
                ]);

        $address->update([
            'is_default' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Default Address Updated'
        ]);
    }
}