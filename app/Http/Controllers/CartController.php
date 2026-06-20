<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $cart = session()->get('cart', []);
        $viewData["cart"] = $cart;
        $total = 0;
        foreach ($cart as $item) {
            $total += $item["price"] * $item["quantity"];
        }
        $viewData["total"] = $total;
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]["quantity"]++;
        } else {
            $cart[$productId] = [
                "name" => $product->getName(),
                "price" => $product->getPrice(),
                "image" => $product->getImage(),
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    public function purchase()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item["price"] * $item["quantity"];
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $order = Order::create([
            'total' => $total,
            'user_id' => $user->getId(),
        ]);
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'quantity' => $item["quantity"],
                'price' => $item["price"],
                'order_id' => $order->getId(),
                'product_id' => $productId,
            ]);
        }
        session()->forget('cart');
        return redirect()->route('order.index');
    }
}