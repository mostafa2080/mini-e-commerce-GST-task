<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(AddToCartRequest $request)
    {
        $userId = $request->user()->id;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $existingCartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }


    public function getUserCart()
    {
        $cartItems = auth()->user()->cart;
        return response()->json(['cart' => $cartItems]);
    }
}
