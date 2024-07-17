<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\Kategori;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1', 
        ]);

        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $quantity = $request->input('qty', 1);

        $keranjang = Cart::where('user_id', Auth::id())->where('produk_id', $id)->first();

        if ($keranjang) {
            $keranjang->qty += $quantity;
            $keranjang->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'produk_id' => $id,
                'qty' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
{
    $kategori = Kategori::all(); // Fetch all categories
    $keranjang = Cart::where('user_id', Auth::id())->with('produk')->get(); // Fetch user's cart items with associated products
    return view('cart', compact('keranjang', 'kategori')); // Pass data to the cart view
}


    public function update(Request $request, $id)
    {
        $keranjang = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($keranjang) {
            $keranjang->qty = $request->qty;
            $keranjang->save();
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Cart item not found!');
    }

    public function delete($id)
    {
        $keranjang = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($keranjang) {
            $keranjang->delete();
            return redirect()->back()->with('success', 'Cart item removed successfully!');
        }

        return redirect()->back()->with('error', 'Cart item not found!');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'All cart items removed successfully!');
    }
}