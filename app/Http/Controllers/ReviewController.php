<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'product')->latest()->get();

        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        Review::create([

            'user_id' => auth()->id(),

            'product_id' => $request->product_id,

            'rating' => $request->rating,

            'review' => $request->review,

        ]);

        return back()->with('success', 'Review added');
    }

    public function storeApi(Request $request)
    {
        try {

            $request->validate([

                'user_id' => 'required',

                'product_id' => 'required',

                'rating' => 'required|integer|min:1|max:5',

                'review' => 'required',

                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'

            ]);

            $exists = Review::where('user_id', $request->user_id)

                ->where('product_id', $request->product_id)

                ->where('id', '!=', $request->editingId)

                ->exists();

            // ALREADY REVIEWED

            if ($exists) {

                return response()->json([

                    'success' => false,

                    'message' => 'You already reviewed this product'

                ], 400);

            }

            // IMAGE UPLOAD

            $imageName = null;

            if ($request->hasFile('image')) {

                $imageName = time() .

                    '.' .

                    $request->image->extension();

                $request->image->move(

                    public_path('reviews'),

                    $imageName

                );
            }

            // CREATE REVIEW

            $review = Review::create([

                'user_id' => $request->user_id,

                'product_id' => $request->product_id,

                'rating' => $request->rating,

                'review' => $request->review,

                'image' => $imageName

            ]);

            return response()->json([

                'success' => true,

                'message' => 'Review Added Successfully',

                'review' => $review

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);

        }
    }
    public function productReviews($productId)
    {
        $reviews = Review::with('user')

            ->where('product_id', $productId)

            ->latest()

            ->get();

        return response()->json($reviews);
    }

    public function update(Request $request, $id)
    {

        $review = Review::findOrFail($id);

        // ONLY OWNER CAN EDIT

        if ($review->user_id != $request->user_id) {

            return response()->json([

                'message' => 'Unauthorized'

            ], 403);

        }

        $imageName = $review->image;

        // NEW IMAGE

        if ($request->hasFile('image')) {

            $imageName = time() .

                '.' .

                $request->image->extension();

            $request->image->move(

                public_path('reviews'),

                $imageName

            );
        }

        $review->update([

            'rating' => $request->rating,

            'review' => $request->review,

            'image' => $imageName

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Review Added Successfully',

            'review' => $review

        ]);
    }

    public function destroy(Request $request, $id)
    {

        $review = Review::findOrFail($id);

        // ONLY OWNER DELETE

        if ($review->user_id != $request->user_id) {

            return response()->json([

                'message' => 'Unauthorized'

            ], 403);

        }

        $review->delete();

        return response()->json([

            'success' => true,

            'message' => 'Review Deleted Successfully'

        ]);
    }






    public function edit($id)
    {
        $reviews = Review::with('user', 'product')
            ->latest()
            ->get();

        $editReview = Review::findOrFail($id);

        return view('reviews', compact(
            'reviews',
            'editReview'
        ));
    }

    public function canReview($productId, $userId)
    {
        $hasPurchased = Order::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('status', 'delivered')
            ->exists();

        return response()->json([
            'canReview' => $hasPurchased
        ]);
    }









}

