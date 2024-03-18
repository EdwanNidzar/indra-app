<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'PKL | Show Data')

<!-- isi bagian konten -->
@section('konten')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Data PKL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('pkl.index') }}">PKL</a></li>
              <li class="breadcrumb-item active">Show Data PKL</li>
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
                  <form action="{{ route('pkl.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md">
                          <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" class="form-control" name="nomor_surat" value="{{ $data->nomor_surat }}"
                              readonly>
                          </div>
                          <div class="form-group">
                            <label for="tempat_pkl">Tempat PKL</label>
                            <textarea readonly name="tempat_pkl" id="tempat_pkl" class="form-control" cols="30" rows="5"
                              placeholder="Ex : STIEI Banjarmasin, Jl. Brig Jend. Hasan Basri No.9 - 11, Pangeran, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70124">{{ $data->tempat_pkl }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="lama_pkl">Lama PKL</label>
                            <input type="text" class="form-control" name="lama_pkl" value="{{ $data->lama_pkl }}"
                              readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                              value="{{ $data->tanggal_mulai }}" readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                              value="{{ $data->tanggal_selesai }}" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bukti_pembayaran">Bukti Pembayaran</label> <br>
                            @if ($data->bukti_pembayaran)
                              <img src="{{ $data->bukti_pembayaran }}" alt="Bukti Pembayaran" width="100"
                                height="100">
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="surat_pernyataan">Surat Pernyataan</label> <br>
                            @if ($data->surat_pernyataan)
                              <img src="{{ $data->surat_pernyataan }}" alt="Status Pembayaran" width="100"
                                height="100">
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
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
