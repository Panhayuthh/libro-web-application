<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('order', ['orders' => $orders]);
    }

    public function history()
    {
        return view('history');
    }

    public function store(Request $request) {
        // dd($request->all());

        $order = new Order();
        $order->user_id = Auth::id();
        $order->delivery_id = $request->option;
        $order->total = $request->total;
        $order->save();

        foreach ($request->menuItem_ids as $key => $value) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->menu_item_id = $value;
            $order_item->quantity = $request->quantities[$key];
            $order_item->size_id = $request->cart_item_sizes[$key];
            try {
                $order_item->save();
            } 
            catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        try {
            $deleteCart = app(CartController::class)->destroyCart($request->cart_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete cart');
        }

        return redirect()->back()->with('success', 'Order created successfully');
    }
}
