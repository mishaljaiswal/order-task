<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Jobs\ProcessOrderJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'      => $request->user_id,
                'total_amount' => $request->total_amount,
            ]);

            foreach ($request->items as $product) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity'   => $product['quantity'],
                    'price'      => $product['price'],
                ]);
            }

            ProcessOrderJob::dispatch($order);
            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Order placed successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Order failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
