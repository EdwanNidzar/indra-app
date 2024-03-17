<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'Mahasiswa Aktif | Tambah Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('mahasiswaaktif.index') }}">Mahasiswa Aktif</a></li>
              <li class="breadcrumb-item active">Tambah Data Mahasiswa Aktif</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <!-- general form elements -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">@yield('judul_halaman')</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('mahasiswaaktif.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md">
                          <div class="form-group">
                            <label for="tujuan_surat">Tujuan Surat</label>
                            <textarea name="tujuan_surat" id="tujuan_surat" class="form-control" cols="30" rows="10"
                              placeholder="Masukkan Tujuan Pengajuan Surat"></textarea>
                            @error('tujuan_surat')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a href="{{ route('mahasiswaaktif.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </section>
  </div>
@endsection
