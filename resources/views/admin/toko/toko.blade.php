@extends('admin.main')
@section('isi')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Toko</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Toko</a></li>
                <li class="breadcrumb-item active">Edit Toko</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
            </div>
        </div>

        </div>

        <div class="col-lg-12 ms-auto me-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Toko</h5>
                    <!-- Vertical Form -->
                    <form action="{{ route('updateprod', ['id' => $Toko->id]) }}" method="POST" enctype="multipart/form-data" class="row g-3">

                        @csrf

                        <div class="col-12">
                            <label for="Toko" class="form-label fw-bold">Nama Toko</label>
                            <input type="text" class="form-control @error('Toko') is-invalid @enderror" name="Toko" id="Toko" placeholder="Masukkan Nama Toko" value="{{ $Toko->Toko }}">
                            @error('Toko')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="cover" class="form-label fw-bold">Cover</label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" id="cover">
                            @error('cover')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                @if ($Toko->cover)
                                    <img style="width: 200px; height: auto; object-fit: cover;" src="{{ asset('storage/Toko/' . $Toko->cover) }}" alt="Cover Toko">
                                @else
                                    <img id="coverPreview" style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('path_to_default_image.jpg') }}" alt="Cover Preview">
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="gambar" class="form-label fw-bold">Gambar Tambahan</label>
                            <input type="file" class="form-control @error('gambar.*') is-invalid @enderror" name="gambar[]" id="gambar" multiple>
                            @error('gambar.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                           <?php $key = 0; ?>
                        @if ($Toko->gambar)
                        <div class="row">
                            @foreach ($Toko->gambar as $gambar)
                            <div class="col-4">
                                <img src="{{ asset('storage/imgToko/'.$gambar->gambar) }}" alt="" width="210px"
                                    height="200px" class="my-3">


                            </div>
                            @endforeach


                        </div>
                        @endif
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-6">
                                <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoriData as $kategori)
                                        <option value="{{ $kategori->id }}" {{ ($kategori->id == $Toko->kategori_id) ? 'selected' : '' }}>{{ $kategori->kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="harga" class="form-label fw-bold">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" min="0" placeholder="Masukkan harga" required value="{{ $Toko->harga }}">
                                </div>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="col-12">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <div id="editor">{!! $Toko->deskripsi !!}</div>
                            <input type="hidden" name="deskripsi" id="deskripsi" value="{{ $Toko->deskripsi }}">
                        </div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                    <a href="{{ route('showsprod') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="col-lg-12 ms-auto me-auto">
        <div class="card">
        <div class="card-body">
        <h5 class="card-title">Edit/Hapus Gambar</h5>

        @foreach ($Toko->gambar as $gambar)
        <div class="col-4">
        <img src="{{ asset('storage/imgToko/'.$gambar->gambar) }}" alt="" width="210px"
            height="200px" class="my-3">
        <form method="POST" action="{{ route('editgambar', $gambar->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="file" value="Masukkan Gambar disini" name="gambar"
                class="form-control w-75" id="defaultFormControlInput"
                aria-describedby="defaultFormControlHelp" />
                <div style="display: flex;">
            <button  class="btn btn-warning "type="submit" style="margin-right: 2%; margin-top:2%;"><i class="bi bi-check-circle"></i></button>
        </form>
        <form method="POST" action="{{ route('hapusgambar', $gambar->id) }}" class="form-hapus">
            @csrf
            @method('DELETE')
            <button  class="btn btn-danger "type="submit" style="margin-top:15%;"><i class="bi bi-trash"></i></button>
        </div>
        </form>
        </div>
        @endforeach

        </div>
        </div>
        </div>
        </section>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var coverInput = document.getElementById('cover');
    var coverPreview = document.getElementById('coverPreview');

    coverInput.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            coverPreview.src = reader.result;
        }

        reader.readAsDataURL(file);
    });

    // Tambahkan kode berikut untuk menampilkan gambar lama
    var oldCoverUrl = '{{ asset('storage/Toko/' . $Toko->cover) }}';

    // Periksa apakah gambar lama tersedia
    var http = new XMLHttpRequest();
    http.open('HEAD', oldCoverUrl, false);
    http.send();

    if(http.status !== 404){
        coverPreview.src = oldCoverUrl;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var editor = new Quill('#editor', {
        theme: 'snow'
    });

    var deskripsiInput = document.getElementById('deskripsi');
    var deskripsiValue = deskripsiInput.value;

    editor.clipboard.dangerouslyPasteHTML(deskripsiValue);

    editor.on('text-change', function() {
        deskripsiInput.value = editor.root.innerHTML;
    });
});

</script>
@endsection
