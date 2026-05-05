<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;          
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Display the checkout form.
     */
   public function index()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $categories = Category::all(); 
            $products   = Product::all(); 


    return view('checkout.index', compact('cart', 'total', 'categories', 'products')); 
    }


    /**
     * Process the checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'shipping_address' => $request->address,
            'city' => $request->city,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cart as $productId => $item) {
            $order->orderItems()->create([
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear cart
        Session::forget('cart');

        return redirect('/order/success')->with(['success' => 'Order placed successfully!', 'order_id' => $order->id]);
    }

    /**
     * Display order success page.
     */
    public function success()
    {
        return view('order-success');
    }
}