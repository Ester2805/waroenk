<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // menampilkan halaman keranjang belanja
    public function index(){
        //ambil data semua produk
        $cartItems = Product::all();

        // kirimd data ke view keranjang  dengan nama variabel 'items'
        return view('keranjang', ['items' => $cartItems]);
    }
}

