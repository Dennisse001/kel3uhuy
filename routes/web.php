<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DetailProdController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopProdController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/dashboard', function () {
    return view('utama.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    //profile admin
    Route::get('/admin/profile', [AdminController::class, 'admindashboard'])->name('dash.admin');
    Route::post('/admin/profile/store', [AdminController::class, 'adminprofilestore'])->name('profile.admin.store');

    //dashboard admin
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'dashadmin'])->name('dashboard');

    //user
    Route::get('/user-list', [EditUserController::class, 'showUser'])->name('showsuser');
    Route::get('/user/edit/{id}', [EditUserController::class, 'edituser'])->name('edituser');
    Route::post('/user/update/{id}', [EditUserController::class, 'updateuser'])->name('updateuser');
    Route::get('/admin/user/hapus/{id}', [EditUserController::class, 'hapususer'])->name('hapususer');

    //kategori
    Route::get('/admin/kategori', [KategoriController::class, 'showKat'])->name('showskat');
    Route::get('/tambah_kat', [KategoriController::class, 'tambahkat'])->name('tambahkat');
    Route::post('/add_kat', [KategoriController::class, 'addkat'])->name('addkat');
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'editKat'])->name('editKat');
    Route::post('/admin/kategori/update/{id}', [KategoriController::class, 'updateKat'])->name('updateKat');
    Route::get('/admin/kategori/hapus/{id}', [KategoriController::class, 'hapusKat'])->name('hapusKat');

    //produk
    Route::get('/admin/produk', [ProdukController::class, 'showProd'])->name('showsprod');
    Route::get('/tambah_prod', [ProdukController::class, 'tambahprod'])->name('tambahprod');
    Route::post('/add_prod', [ProdukController::class, 'addprod'])->name('addprod');
    Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'editProd'])->name('editprod');
    Route::post('/admin/produk/update/{id}', [ProdukController::class, 'updateprod'])->name('updateprod');
    Route::get('/admin/produk/hapus/{id}', [ProdukController::class, 'hapusprod'])->name('hapusprod');

    //gambar

Route::delete('/hapusgambar/{id}', [ProdukController::class, 'hapusGambar'])->name('hapusgambar');
Route::post('/editgambar/{id}',[ProdukController::class, 'editGambar'])->name('editgambar');

});

// Route About

Route::get('/about', function () {
    return view('utama.about');
});

// Route Shop
Route::get('/shop', [ShopProdController::class, 'shop'])->name('shop');
Route::get('/search', [ShopProdController::class, 'search'])->name('search');

//Route DetailProduk
Route::get('/produk/{id}', [DetailProdController::class],'detail_produk')->name('detailprod');





// Route Blog

Route::get('/blog', function () {
    return view('utama.blog');
});

Route::get('/blogdetails', function () {
    return view('utama.blogdetail');
});
