<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'Pengajuan Cuti | Show Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Pengajuan Cuti</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Pengajuan Cuti</a></li>
              <li class="breadcrumb-item active">Show Pengajuan Cuti</li>
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
                  <form action="{{ route('cuti.update', $data->id) }}" method="POST">
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
                            <label for="alasan_cuti">Alasan Cuti</label>
                            <textarea name="alasan_cuti" id="alasan_cuti" class="form-control" cols="30" rows="5"
                              placeholder="Masukan Alasan Cuti" readonly>{{ $data->alasan_cuti }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="tanggal_mulai">Mulai Tanggal</label>
                            <input type="text" value="{{ $data->tanggal_mulai }}" name="tanggal_mulai"
                              id="tanggal_mulai" class="form-control" readonly>
                          </div>
                          <div class="form-group">
                            <label for="tanggal_selesai">Sampai Tanggal</label>
                            <input type="text" value="{{ $data->tanggal_mulai }}" name="tanggal_selesai"
                              id="tanggal_selesai" class="form-control" readonly>
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
                      <a href="{{ route('cuti.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
