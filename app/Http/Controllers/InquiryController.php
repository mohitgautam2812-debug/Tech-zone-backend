<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $query = auth()->user()->hasRole('admin')
            ? Inquiry::with('product')
            : Inquiry::with('product')->whereHas('product', function ($q) {
                $q->where('user_id', auth()->id());
            });

        if (request('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        }

        $inquiries = $query->latest()->get();

        return view('inquiries', compact('inquiries'));
    }

    public function store(Request $request)
    {
        Inquiry::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent');
    }

    public function updateStatus(Request $request, $id)
    {
        Inquiry::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status updated!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string']);
        Inquiry::findOrFail($id)->update([
            'reply' => $request->reply,
            'status' => 'replied',
        ]);
        return back()->with('success', 'Reply sent successfully!');
    }

    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return back()->with('success', 'Inquiry deleted!');
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $ownerUserId = null;
        if ($request->product_id) {
            $product = \App\Models\Product::find($request->product_id);
            $ownerUserId = $product?->user_id;
        }

        $fullMessage = $request->message;
        if ($request->phone)
            $fullMessage .= "\n Phone: " . $request->phone;
        if ($request->city)
            $fullMessage .= "\n City: " . $request->city;
        if ($request->purpose)
            $fullMessage .= "\n Purpose: " . $request->purpose;
        if ($request->budget)
            $fullMessage .= "\n Budget: " . $request->budget;

        $inquiry = Inquiry::create([
            'user_id' => $ownerUserId ?? 1,
            'product_id' => $request->product_id ?? null,
            'name' => $request->name,
            'email' => $request->email ?? null,
            'message' => $fullMessage,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Inquiry sent successfully!',
            'data' => $inquiry,
        ], 201);
    }
}