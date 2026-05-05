<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the database with orders.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        $orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        for ($i = 0; $i < 8; $i++) {
            $user = $users->random();
            $itemCount = rand(2, 3);
            $totalAmount = 0;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => $orderStatuses[array_rand($orderStatuses)],
                'payment_method' => ['credit_card', 'debit_card', 'bank_transfer', 'cash'][array_rand(['credit_card', 'debit_card', 'bank_transfer', 'cash'])],
                'shipping_address' => $user->address . ', ' . $user->phone,
                'total_amount' => 0, // Will update after adding items
            ]);

            // Create order items
            $selectedProducts = $products->random($itemCount);

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 5);
                $price = $product->price;
                $itemTotal = $price * $quantity;
                $totalAmount += $itemTotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            // Update order total amount
            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
