<?php

namespace App\Http\Controllers;
use App\Models\Produk;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){

        $produk = Produk::paginate(4);
        return view('index', compact('produk'));
    }

    public function shop(){
        $produk = Produk::all();
        return view('shop',['produk'=>$produk]);
    }


    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail', compact('produk'));
    }

    public function cart(){
        $produk = Produk::all();
        return view('cart',['produk'=>$produk]);
    }
}
