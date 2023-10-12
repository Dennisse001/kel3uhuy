<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function dashadmin() {

        $produk = Produk::count();
        $kategori = Kategori::count();
        $user = User::count();
        return view('admin.dashboard.utama', compact('produk','kategori','user'));

    }
}
