<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Jobs\ProcessOrderJob;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $product = Product::first();
            $quantity = $request->input('quantity');

            if (!$product) {
                throw new \Exception("Product not found.");
            }

            if ($product->stock_quantity < $quantity) {
                throw new \Exception("Insufficient stock.");
            }

            $product->stock_quantity -= $quantity;
            $product->save();

            $order = Order::create([
                'user_id' => 1,
                'total_amount' => $product->price * $quantity,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);

            // ProcessOrderJob::dispatch($order->id);
            dispatch(new ProcessOrderJob($order->id));

            DB::commit();

            return response()->json(['status' => true, 'message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Order failed', 'error' => $e->getMessage()]);
        }
    }
}
