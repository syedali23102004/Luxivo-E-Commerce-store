<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        // Calculate total
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Check if product already exists in cart
        if (isset($cart[$product->id])) {
            // Increment quantity
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Add new item to cart
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount_price ?? $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Update cart item quantity.
     */
   public function update(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'quantity'   => 'required|integer|min:0|max:99', 
    ]);

    $cart = session()->get('cart', []);

    if (isset($cart[$request->product_id])) {
        if ($request->quantity == 0) {
            unset($cart[$request->product_id]); 
        } else {
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Cart updated successfully!');
}


    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Get cart count for AJAX requests.
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json(['count' => $count]);
    }
}