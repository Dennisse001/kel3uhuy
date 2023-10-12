@extends('admin.main')
@section('isi')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form kategori</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</a></li>
          <li class="breadcrumb-item">kategori</li>
          <li class="breadcrumb-item active">Edit kategori</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit kategori</h5>

              <!-- General Form Elements -->


<form method="POST" enctype="multipart/form-data" action="{{ route('updateKat', ['id' => $kategori->id]) }}">
    @csrf

    <div class="row mb-3">
      <label for="kategori" class="col-sm-2 col-form-label">kategori</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="kategori" id="kategori" value="{{ $kategori->kategori }}">
      </div>
    </div>

    <div class="row mb-3">
        <label for="cover" class="col-sm-2 col-form-label">Cover</label>
        <div class="col-sm-4">
            <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" id="cover">
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                @if ($kategori->cover)
                <img style="width: 200px; height: auto; object-fit: cover;" src="{{ asset('storage/kategori/' . $kategori->cover) }}" alt="Cover Kategori">
            @else
                <img id="coverPreview" style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('path_to_default_image.jpg') }}" alt="Cover Preview">
            @endif
            </div>
        </div>
    </div>



    <div class="row mb-3">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Update Form</button>
      </div>
    </div>

  </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        <div class="col-lg-6">



            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
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
      var oldCoverUrl = '{{ asset('storage/kategori/' . $kategori->cover) }}';

      // Periksa apakah gambar lama tersedia
      var http = new XMLHttpRequest();
      http.open('HEAD', oldCoverUrl, false);
      http.send();

      if(http.status !== 404){
          coverPreview.src = oldCoverUrl;
      }
  });
  </script>
@endsection








