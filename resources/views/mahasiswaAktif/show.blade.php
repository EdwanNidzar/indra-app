<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'Mahasiswa Aktif | Show Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('mahasiswaaktif.index') }}">Mahasiswa Aktif</a></li>
              <li class="breadcrumb-item active">Show Data Mahasiswa Aktif</li>
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
                  <form action="{{ route('mahasiswaaktif.update', $data->id) }}" method="POST">
                    @csrf

                    <input name="nomor_surat" type="hidden" value="{{ $data->nomor_surat }}">

                    <div class="card-body">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md">
                          <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input name="nomor_surat" class="form-control" type="text"
                              value="{{ $data->nomor_surat }} "readonly>
                          </div>
                          <div class="form-group">
                            <label for="name">Nama Mahasiswa</label>
                            <input name="name" class="form-control" type="text" value="{{ $data->name }} "
                              readonly>
                          </div>
                          <div class="form-group">
                            <label for="tujuan_surat">Tujuan Surat</label>
                            <textarea name="tujuan_surat" id="tujuan_surat" class="form-control" cols="30" rows="10"
                              placeholder="Masukkan Tujuan Pengajuan Surat" readonly>{{ $data->tujuan_surat }} </textarea>
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <input name="status" class="form-control" type="text"
                              value="{{ $data->status }} "readonly>
                          </div>

                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
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
