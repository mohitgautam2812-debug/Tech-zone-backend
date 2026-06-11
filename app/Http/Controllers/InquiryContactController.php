<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class InquiryContactController extends Controller
{

    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        $inquiry = ContactInquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully. We will get back to you within 1 hour.',
            'data' => $inquiry,
        ], 201);
    }


    public function index(Request $request)
    {
        $query = ContactInquiry::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->paginate(10)->withQueryString();
        $totalCount = ContactInquiry::count();
        $unreadCount = ContactInquiry::where('status', 'unread')->count();
        $readCount = ContactInquiry::where('status', 'read')->count();

        return view('ContactInquery', compact(
            'inquiries',
            'totalCount',
            'unreadCount',
            'readCount'
        ));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create($validated);

        return back()->with('success', 'Inquiry created successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:unread,read',
        ]);

        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'status' => $inquiry->status,
        ]);
    }


    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $inquiry = ContactInquiry::findOrFail($id);

        $inquiry->update([
            'reply' => $request->reply,
            'status' => 'read'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully.'
        ]);
    }


    public function destroy($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inquiry deleted successfully.',
        ]);
    }

    public function userInquiries($email)
    {
        return ContactInquiry::where('email', $email)
            ->latest()
            ->get();
    }
}