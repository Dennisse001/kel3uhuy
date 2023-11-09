<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DetailProdController extends Controller
{
    public function detail_produk($id){

        $produk = Produk::with(['kategori', 'gambar'])->find($id);


        return view('utama.detail_produk', compact('    produk'));

    }
}
