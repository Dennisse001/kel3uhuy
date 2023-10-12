<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ShopProdController extends Controller
{
    public function shop() {


        $productCount = Produk::count();
            $data = Produk::orderBy('created_at', 'desc')->get();

            $tada = Kategori::orderBy('created_at', 'desc')->get();

            return view('utama.shop', compact('data','tada','productCount'));

    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Lakukan pencarian berdasarkan $query di database
    $results = Produk::where('produk', 'like', '%' . $query . '%')->get();

    return view('hasil_pencarian', ['results' => $results]);
}
}
