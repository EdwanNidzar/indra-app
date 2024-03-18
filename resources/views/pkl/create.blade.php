<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'PKL | Tambah Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data PKL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('pkl.index') }}">PKL</a></li>
              <li class="breadcrumb-item active">Tambah Data PKL</li>
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
                  <form action="{{ route('pkl.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md">
                          <div class="form-group">
                            <label for="tempat_pkl">Tempat PKL</label>
                            <textarea name="tempat_pkl" id="tempat_pkl" class="form-control" cols="30" rows="5"
                              placeholder="Ex : STIEI Banjarmasin, Jl. Brig Jend. Hasan Basri No.9 - 11, Pangeran, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70124"></textarea>
                            @error('tempat_pkl')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="lama_pkl">Lama PKL</label>
                            <select name="lama_pkl" id="lama_pkl" class="form-control">
                              <option value="2 Bulan">2 Bulan</option>
                              <option value="3 Bulan">3 Bulan</option>
                            </select>
                            @error('lama_pkl')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                            @error('tanggal_mulai')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                            @error('tanggal_selesai')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                            <input type="file" accept="image/*" name="bukti_pembayaran" id="bukti_pembayaran"
                              class="form-control">
                            @error('bukti_pembayaran')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="surat_pernyataan">Surat Pernyataan</label>
                            <input type="file" accept="image/*" name="surat_pernyataan" id="surat_pernyataan"
                              class="form-control">
                            @error('surat_pernyataan')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <a href="{{ route('pkl.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
