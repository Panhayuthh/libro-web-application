<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{
    public function show() {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );
    
        $cartItems = CartItem::where('cart_id', $cart->id)
                    ->join('menu_items', 'cart_items.menu_item_id', '=', 'menu_items.id')
                    ->select('cart_items.*', 'menu_items.name', 'menu_items.price')
                    ->get();
    
        $subtotal = $cartItems->sum(fn ($item) => $item->price * $item->quantity);
    
        $tax = $subtotal * 0.10;
        $delivery = 5;
        $total = $subtotal + $tax + $delivery;
    
        return [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'delivery' => $delivery,
            'total' => $total
        ];
    }
    

    public function createCart(int $userId)
    {
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->save();

        return $cart;
    }

    public function createCartItem(Request $request)
    {
        // dd($request->all());

        if (Gate::denies('add-to-cart')) {
            return redirect()->route('login');
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = $this->createCart(Auth::id());
        }

        $cartItem = new CartItem();
        $cartItem->cart_id = $cart->id;
        $cartItem->menu_item_id = $request->menu_item_id;
        $cartItem->quantity = $request->quantity;
        $cartItem->size_id = ($request->size === 'small' ? '1' : '2');
        $cartItem->save();

        return redirect()->route('menu');
    }

    public function destroyCartItem(CartItem $cartItem)
    {
        // dd($cartItem->id);

        if (Gate::denies('add-to-cart')) {
            return redirect()->route('login');
        }
        
        try {
            $cartItem->delete();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return back();
    }   
}
