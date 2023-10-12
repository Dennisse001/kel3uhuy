<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function home() {

    $data = Produk::orderBy('created_at', 'desc')->get();

    $tada = Kategori::orderBy('created_at', 'desc')->get();

    return view('utama.dashboard', compact('data','tada'));

}


}
