<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refund;
use App\Models\ReturnRequest;
use App\Models\Order;
use Carbon\Carbon;  

class RefundController extends Controller
{
    
    public function index()
    {
        $refunds = Refund::with(['returnRequest.order.product', 'order', 'user'])
            ->latest()
            ->get();

        return view('refund', compact('refunds'));
    }

   
    public function create(Request $request)
    {
        $request->validate([
            'return_id'     => 'required|exists:returns,id',
            'refund_amount' => 'required|numeric|min:1',
            'refund_method' => 'required|in:original_payment,bank_transfer,wallet,upi,cash',
            'admin_notes'   => 'nullable|string|max:500',

           
            'bank_account_number' => 'required_if:refund_method,bank_transfer|nullable|string',
            'bank_ifsc'           => 'required_if:refund_method,bank_transfer|nullable|string',
            'upi_id'              => 'required_if:refund_method,upi|nullable|string',
        ]);

        $returnRequest = ReturnRequest::with('order')->findOrFail($request->return_id);

      
        if (!in_array($returnRequest->status, ['approved', 'request_approved'])) {
            return back()->with('error', 'Return request must be approved before initiating a refund.');
        }

       
        $existing = Refund::where('return_id', $request->return_id)
            ->whereIn('status', ['pending', 'processing', 'completed'])
            ->first();

        if ($existing) {
            return back()->with('error', 'A refund already exists for this return request.');
        }

        $refund = Refund::create([
            'return_id'           => $request->return_id,
            'order_id'            => $returnRequest->order_id,
            'user_id'             => $returnRequest->user_id,
            'refund_amount'       => $request->refund_amount,
            'refund_method'       => $request->refund_method,
            'bank_account_number' => $request->bank_account_number,
            'bank_ifsc'           => $request->bank_ifsc,
            'upi_id'              => $request->upi_id,
            'admin_notes'         => $request->admin_notes,
            'status'              => 'processing',
            'processed_at'        => Carbon::now(),
        ]);

       
        $returnRequest->update(['status' => 'refunded']);

     
        if ($returnRequest->order) {
            $returnRequest->order->update(['status' => 'refunded']);
        }

        return back()->with('success', 'Refund initiated successfully for ₹' . number_format($request->refund_amount, 2));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'         => 'required|in:pending,processing,completed,failed',
            'transaction_id' => 'nullable|string|max:255',
            'failure_reason' => 'nullable|string|max:500',
            'admin_notes'    => 'nullable|string|max:500',
        ]);

        $refund = Refund::findOrFail($id);
        $refund->status         = $request->status;
        $refund->transaction_id = $request->transaction_id ?? $refund->transaction_id;
        $refund->admin_notes    = $request->admin_notes    ?? $refund->admin_notes;
        $refund->failure_reason = $request->failure_reason ?? $refund->failure_reason;

        if ($request->status === 'completed') {
            $refund->completed_at = Carbon::now();
        }

        $refund->save();

        return back()->with('success', 'Refund status updated to ' . ucfirst($request->status));
    }

 
    public function apiStore(Request $request)
    {
        $request->validate([
            'return_id'           => 'required|exists:returns,id',
            'user_id'             => 'required|exists:users,id',
            'refund_method'       => 'required|in:original_payment,bank_transfer,wallet,upi,cash',
            'bank_account_number' => 'required_if:refund_method,bank_transfer|nullable|string',
            'bank_ifsc'           => 'required_if:refund_method,bank_transfer|nullable|string',
            'upi_id'              => 'required_if:refund_method,upi|nullable|string',
        ]);

        $returnRequest = ReturnRequest::with('order')->findOrFail($request->return_id);

      
        if ($returnRequest->user_id !== (int) $request->user_id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        
        if (!in_array($returnRequest->status, ['approved', 'request_approved'])) {
            return response()->json([
                'success' => false,
                'message' => 'Your return request must be approved before a refund can be processed.'
            ], 422);
        }

       
        $existing = Refund::where('return_id', $request->return_id)
            ->whereIn('status', ['pending', 'processing', 'completed'])
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'A refund is already in progress for this return.'
            ], 422);
        }

        
        $refundAmount = $returnRequest->order ? $returnRequest->order->total_price : 0;

        $refund = Refund::create([
            'return_id'           => $request->return_id,
            'order_id'            => $returnRequest->order_id,
            'user_id'             => $request->user_id,
            'refund_amount'       => $refundAmount,
            'refund_method'       => $request->refund_method,
            'bank_account_number' => $request->bank_account_number,
            'bank_ifsc'           => $request->bank_ifsc,
            'upi_id'              => $request->upi_id,
            'status'              => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Refund request submitted. We will process it within 5-7 business days.',
            'data'    => $refund
        ], 201);
    }

  
    public function apiStatus($orderId)
    {
        $refund = Refund::where('order_id', $orderId)
            ->with(['returnRequest'])
            ->latest()
            ->first();

        if (!$refund) {
            return response()->json([
                'success' => false,
                'message' => 'No refund found for this order',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'             => $refund->id,
                'status'         => $refund->status,
                'refund_amount'  => $refund->refund_amount,
                'refund_method'  => $refund->refund_method,
                'transaction_id' => $refund->transaction_id,
                'processed_at'   => $refund->processed_at?->toISOString(),
                'completed_at'   => $refund->completed_at?->toISOString(),
                'failure_reason' => $refund->failure_reason,
            ]
        ]);
    }
    public function apiUserRefunds($userId)
    {
        $refunds = Refund::where('user_id', $userId)
            ->with(['order.product'])
            ->latest()
            ->get()
            ->map(fn($r) => [
                'id'             => $r->id,
                'status'         => $r->status,
                'refund_amount'  => $r->refund_amount,
                'refund_method'  => $r->refund_method,
                'transaction_id' => $r->transaction_id,
                'processed_at'   => $r->processed_at?->toISOString(),
                'completed_at'   => $r->completed_at?->toISOString(),
                'failure_reason' => $r->failure_reason,
                'order'          => $r->order,
            ]);

        return response()->json(['success' => true, 'data' => $refunds]);
    }
}