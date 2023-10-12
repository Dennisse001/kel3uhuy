<?php

namespace App\Http\Controllers;

use App\Models\gambar;
use Illuminate\Http\Request;
use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

    class ProdukController extends Controller
    {
        public function showProd()
        {
            $proData = produk::with(['kategori'])->get();
            $kategoriData = kategori::all();

            return view('admin.produk.listprod', compact('proData', 'kategoriData'));
        }

        public function tambahprod()
        {
            $proData = Produk::with(['kategori'])->get();
            $kategoriData = kategori::all();

            return view('admin.produk.tambahprod', compact('proData', 'kategoriData'));
        }

        public function addprod(Request $request)
        {
            $model = new Produk();
            $model->produk = $request->produk;
            $model->deskripsi = $request->deskripsi;
            $model->harga = $request->harga;

            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                @unlink(storage_path('app/public/produk/' . $model->cover));
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/produk', $filename);
                $model->cover = $filename;
            }

            $model->save();

            $model->kategori()->associate($request->kategori_id);
            $model->save();

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $totalGambar = count($gambar);
                if ($totalGambar > 12) {
                    return redirect()->back()->withErrors(['gambar' => 'Gambar yang diperbolehkan maksimal 12']);
                }

                foreach ($gambar as $image) {
                    $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/imgproduk', $filename);

                    $imageModel = new gambar();
                    $imageModel->gambar = $filename;
                    $imageModel->produk_id = $model->id;
                    $imageModel->save();
                }
            }

            return redirect('/admin/produk')->with('success', 'Data produk berhasil ditambahkan.');
        }



        public function editprod($id)
        {
            $produk = Produk::with([ 'kategori'])->find($id);
            $kategoriData = kategori::all();

            return view('admin.produk.editprod', compact('produk', 'kategoriData'));
        }

       public function updateprod(Request $request, $id)
{
          // $request->validate([
            //     'produk' => 'required',
            //     'deskripsi' => 'required',
            //     'harga' => 'required',
            //     'kategori_id' => 'required|exists:kategoris,id',
            // ], [
            //     'produk.required' => 'Produk harus diisi.',
            //     'deskripsi.required' => 'Deskripsi harus diisi.',
            //     'harga.required' => 'Harga harus diisi.',
            //     'kategori_id.required' => 'ID kategori harus diisi.',
            //     'kategori_id.exists' => 'ID kategori tidak valid.'
            // ]);
    $model = Produk::find($id);


    $model->produk = $request->produk;
    $model->deskripsi = $request->deskripsi;
    $model->harga = $request->harga;

    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        @unlink(storage_path('app/public/produk/' . $model->cover));
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/produk', $filename);
        $model->cover = $filename;
    }

    $model->save();

    $model->kategori()->associate($request->kategori_id);
    $model->save();

    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $totalGambar = count($gambar);
        if ($totalGambar > 12) {
            return redirect()->back()->withErrors(['gambar' => 'Gambar yang diperbolehkan maksimal 12']);
        }

        foreach ($gambar as $image) {
            $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/imgproduk', $filename);

            $imageModel = new gambar();
            $imageModel->gambar = $filename;
            $imageModel->produk_id = $model->id;
            $imageModel->save();
        }
    }

    return redirect('/admin/produk')->with('success', 'Data produk berhasil diperbarui.');
}

public function editGambar(Request $request, $id)
{
    $gambar = gambar::findOrFail($id);

    if ($request->hasFile('gambar')) {

        Storage::disk('public')->delete('imgproduk/' . $gambar->gambar);


        $filename = Str::random(10) . '.' . $request->gambar->getClientOriginalExtension();
        $request->gambar->storeAs('public/imgproduk', $filename);
        $gambar->gambar = $filename;
        $gambar->save();

        return redirect()->back()->with('success', 'Gambar berhasil diupdate.');
    }

    return redirect()->back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi.');
}
public function hapusGambar($id)
{
    $gambar = gambar::findOrFail($id);
    $file_path = public_path().'/storage/imgproduk/'.$gambar->gambar;
    if(file_exists($file_path)) {
        unlink($file_path);
    }
    $gambar->delete();
    return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
}

        public function hapusprod($id)
        {

            $produk = Produk::find($id);
            if (!$produk) {
                return redirect()->route('showsprod')->with('error', 'Data produk tidak ditemukan');
            }
            $produk->delete();

            return redirect()->route('showsprod')->with('success', 'Data produk  berhasil dihapus');
        }
    }


