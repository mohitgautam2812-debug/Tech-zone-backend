<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnRequest;

class ReturnController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

       
        $existing = ReturnRequest::where('order_id', $request->order_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'A return request for this order already exists.'
            ], 422);
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('returns', 'public');
        }

        $return = ReturnRequest::create([
            'order_id' => $request->order_id,
            'user_id' => $request->user_id,
            'reason' => $request->reason,
            'description' => $request->description,
            'image' => $image,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Return request submitted successfully',
            'data' => $return
        ], 201);
    }

    
    public function index()
    {
        $returns = ReturnRequest::with(['order.product', 'user'])
            ->latest()
            ->get();

        return view('ReturnOrder', compact('returns'));
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,refunded'
        ]);

        $return = ReturnRequest::with('order')->findOrFail($id);
        $return->status = $request->status;
        $return->save();


        if ($return->order) {
            $orderStatus = match ($request->status) {
                'approved' => 'returned', 
                'refunded' => 'refunded',   
                'rejected' => 'delivered',
                default => null
            };

            if ($orderStatus) {
                $return->order->update(['status' => $orderStatus]);
            }
        }

        return back()->with('success', 'Return status updated to ' . ucfirst($return->status));
    }

    
    public function show($orderId)
    {
        $return = ReturnRequest::where('order_id', $orderId)
            ->with(['order.product', 'user'])
            ->first();

        if (!$return) {
            return response()->json([
                'success' => false,
                'message' => 'No return request found for this order'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $return
        ]);
    }
}

