<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'Izin Penelitian | Edit Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Penelitian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('penelitian.index') }}">Penelitian</a></li>
              <li class="breadcrumb-item active">Edit Data Penelitian</li>
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
                  <form action="{{ route('penelitian.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md">
                          <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" readonly
                              value="{{ $data->nomor_surat }}">
                          </div>
                          <div class="form-group">
                            <label for="tempat_penelitian">Tempat Penelitian</label>
                            <textarea name="tempat_penelitian" id="tempat_penelitian" class="form-control" cols="30" rows="5"
                              placeholder="Ex : STIEI Banjarmasin, Jl. Brig Jend. Hasan Basri No.9 - 11, Pangeran, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70124"
                              readonly>{{ $data->tempat_penelitian }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="judul">Judul Penelitian</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                              placeholder="Masukan Judul Penelitian" readonly value="{{ $data->judul }}">
                          </div>
                          <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                              value="{{ $data->tanggal_mulai }}" readonly>
                          </div>
                          <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                              value="{{ $data->tanggal_selesai }}" readonly>
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" class="form-control" value="{{ $data->status }}"
                              readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a href="{{ route('penelitian.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
