<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth::user();
        if ($user->isAdmin == 1){
            $produk = Produk::all();
            $user = User::count('id');
            return view('admin.indexadmin', compact('produk','user'));
        } else {
            $produk = Produk::all();
            $user = User::count('id');
            return view('index', compact('produk','user'));
        }

    }
}
