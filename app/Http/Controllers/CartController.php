<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $cart = Cart::create([

            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'qty' => $request->quantity,

        ]);

        return response()->json([
            'message' => 'Added to cart',
            'data' => $cart
        ]);
    }



    public function show($userId)
    {

        return Cart::with('product.category')
            ->where('user_id', $userId)
            ->get();

    }



    public function updateQty(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::findOrFail($id);

        $cart->qty = $request->qty;

        $cart->save();

        return response()->json([
            'message' => 'Quantity Updated',
            'data' => $cart
        ]);
    }



    public function destroy($id)
    {

        Cart::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Item Removed'
        ]);

    }

}