<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|in:kg,g',
        ]);

        $product = Product::findOrFail($product_id);
        $warehouse = $product->warehouse;

        if (!$warehouse) {
            return back()->with('error', 'The product is out of stock in the warehouse.');
        }

        $quantityInGrams = ($request->unit == 'kg') ? $request->quantity * 1000 : $request->quantity;

        if ($warehouse->quantity < $quantityInGrams) {
            return back()->with('error', 'Nema dovoljno zaliha.');
        }

        $totalPrice = $product->price * ($quantityInGrams / 1000);

        Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $product_id,
            'quantity' => $quantityInGrams,
            'unit' => $request->unit,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('user.orders')->with('success', 'The order has been created. Awaiting admin approval.');
    }

    public function userOrders(Request $request)
    {
        $orders = Order::with('product')
            ->where('user_id', $request->user()->id)
            ->get();
    
        return view('orders.user_orders', compact('orders'));
    }
    

    public function adminOrders()
    {
        $orders = Order::with('product', 'user')->where('status', 'pending')->get();
        return view('orders.admin_orders', compact('orders'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $product = $order->product;
        $warehouse = $product->warehouse;

        if ($warehouse->quantity < $order->quantity) {
            return back()->with('error', 'There is not enough stock for this order.');
        }

        $warehouse->quantity -= $order->quantity;
        $warehouse->save();

        $order->status = 'approved';
        $order->save();

        return back()->with('success', 'Order approved.');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'rejected';
        $order->save();

        return back()->with('success', 'The order was rejected.');
    }
}
