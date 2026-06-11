<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use App\Mail\NewOrderMail;
class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {

            $orders = Order::with(['product.user', 'user'])->latest()->get();

        } elseif ($user->hasRole('agent')) {

            $orders = Order::with(['product.user', 'user'])
                ->whereHas('product', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->get();

        } else {

            $orders = Order::with(['product.user', 'user'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('orders', compact('orders'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([

                'user_id' => 'required',

                'product_id' => 'required',

                'quantity' => 'required',

                'payment_method' => 'required'

            ]);

            $product = Product::find($request->product_id);

            if (!$product) {

                return response()->json([

                    'success' => false,
                    'message' => 'Product not found'

                ], 404);

            }


            if ($request->payment_method == "cod") {
                $productOwner = $product->user;


                $order = Order::create([

                    'user_id' => $request->user_id,

                    'product_id' => $product->id,

                    'quantity' => $request->quantity,

                    'total_price' =>
                        $product->price * $request->quantity,

                    'status' => 'pending',

                    'payment_status' =>
                        $request->payment_status ?? 'pending',

                    'payment_method' => 'cod',

                    'name' => $request->name ?? '',

                    'email' => $request->email ?? '',

                    'phone' => $request->phone ?? '',

                    'address' => $request->address ?? '',

                    'city' => $request->city ?? '',

                    'state' => $request->state ?? '',

                    'pincode' => $request->pincode ?? '',


                ]);


                \Log::info('Customer Email: ' . $order->email);



                if (!empty($order->email)) {
                    Mail::to($order->email)
                        ->queue(new OrderPlacedMail($order));
                }

                Mail::to($productOwner->email)
                    ->queue(new NewOrderMail($order));

                Mail::to('devisunita131415@gmail.com')
                    ->queue(new NewOrderMail($order));


                return response()->json([

                    'success' => true,
                    'message' => 'COD Order placed successfully',
                    'order' => $order

                ]);



            }


            if ($request->payment_method == "online") {
                $productOwner = $product->user;

                \Log::info($request->all());
                $order = Order::create([

                    'user_id' => $request->user_id,

                    'product_id' => $product->id,

                    'quantity' => $request->quantity,

                    'total_price' =>
                        $product->price * $request->quantity,

                    'status' => 'pending',

                    'payment_status' =>
                        $request->payment_status ?? 'paid',

                    'payment_method' => 'online',

                    'name' => $request->name ?? '',

                    'email' => $request->email ?? '',

                    'phone' => $request->phone ?? '',

                    'address' => $request->address ?? '',

                    'city' => $request->city ?? '',

                    'state' => $request->state ?? '',

                    'pincode' => $request->pincode ?? '',

                ]);

                Mail::to($order->email)
                    ->queue(new OrderPlacedMail($order));

                Mail::to($productOwner->email)
                    ->queue(new NewOrderMail($order));

                Mail::to('devisunita131415@gmail.com')
                    ->queue(new NewOrderMail($order));

                return response()->json([

                    'success' => true,

                    'message' => 'Online Order placed successfully',

                    'order' => $order



                ]);




            }

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);

        }
    }

    public function update(Request $request, $order)
    {
        $request->validate([

            'status' => 'required'

        ]);

        $order = Order::findOrFail($order);

        $orderStatus = match ($request->status) {

            'request_approved' => null,

            'approved' => 'returned',

            'refunded' => 'refunded',

            'rejected' => 'delivered',

            default => $request->status

        };

        if ($orderStatus) {

            $order->status = $orderStatus;

            $order->save();

        }

        return back()->with(
            'success',
            'Order status updated successfully'
        );
    }
    public function pending()
    {
        $user = auth()->user();
        $orders = $this->filteredOrders($user)->where('status', 'pending')->get();
        return view('orders', compact('orders'));
    }

    public function delivered()
    {
        $user = auth()->user();
        $orders = $this->filteredOrders($user)->where('status', 'delivered')->get();
        return view('orders', compact('orders'));
    }

    public function cancelled()
    {
        $user = auth()->user();
        $orders = $this->filteredOrders($user)->where('status', 'cancelled')->get();
        return view('orders', compact('orders'));
    }

    private function filteredOrders($user)
    {
        if ($user->hasRole('admin')) {
            return Order::with(['product.user', 'user'])->latest();
        } elseif ($user->hasRole('agent')) {
            return Order::with(['product.user', 'user'])
                ->whereHas('product', fn($q) => $q->where('user_id', $user->id))
                ->latest();
        } else {
            return Order::with(['product.user', 'user'])
                ->where('user_id', $user->id)
                ->latest();
        }
    }


    public function stripePayment(Request $request)
    {
        try {

            Stripe::setApiKey(
                config('services.stripe.secret')
            );

            $session = Session::create([
                'billing_address_collection' => 'required',
                'customer_email' => $request->email,

                'line_items' => [
                    [

                        'price_data' => [

                            'currency' => 'inr',

                            'product_data' => [

                                'name' => 'Shop Order',

                            ],

                            'unit_amount' =>
                                (int) $request->amount * 100,

                        ],

                        'quantity' => 1,

                    ]
                ],

                'mode' => 'payment',

                'success_url' =>
                    'http://localhost:5173/payment-success',

                'cancel_url' =>
                    'http://localhost:5173/payment-failed',

            ]);

            return response()->json([

                'url' => $session->url

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);

        }
    }



    public function downloadInvoice($id)
    {
        $order = Order::with('product')->findOrFail($id);

        $pdf = Pdf::loadView('invoice', compact('order'));

        return $pdf->download('invoice-' . $order->id . '.pdf');
    }


    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);


        if ($order->status !== 'pending') {

            return response()->json([
                'message' => 'Only pending orders can be cancelled'
            ], 400);

        }

        $order->status = 'cancelled';

        $order->save();

        return response()->json([
            'message' => 'Order cancelled successfully',
            'order' => $order
        ]);
    }






    public function getUserAddress($id)
    {
        $address = Order::where('user_id', $id)
            ->latest()
            ->first();

        return response()->json($address);
    }


    public function paymentHistory($userId)
    {
        return Order::with('product')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }
}




