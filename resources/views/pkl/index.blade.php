<!-- Menghubungkan dengan view template master -->
@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'PKL')

<!-- isi bagian konten -->
@section('konten')

  <!-- Begin Page Content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    @if (session('success'))
      <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
      </div>
      <script>
        setTimeout(function() {
          document.getElementById('success-alert').style.display = 'none';
        }, 3000);
      </script>
    @elseif(session('error'))
      <div id="error-alert" class="alert alert-danger">
        {{ session('error') }}
      </div>
      <script>
        setTimeout(function() {
          document.getElementById('error-alert').style.display = 'none';
        }, 3000);
      </script>
    @endif

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('judul_halaman')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">PKL</li>
            </ol>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="penelitian" class="table table-bordered table-hover">
                    <thead class="text-center">
                      <tr style="height: 50px;">
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nomor Surat</th>
                        <th class="text-center align-middle">Nama Mahasiswa</th>
                        <th class="text-center align-middle">Tempat PKL</th>
                        <th class="text-center align-middle">Lama PKL</th>
                        <th class="text-center align-middle">Tanggal Mulai</th>
                        <th class="text-center align-middle">Tanggal Selesai</th>
                        <th class="text-center align-middle">Bukti Pembayaran</th>
                        <th class="text-center align-middle">Surat Pernyataan</th>
                        <th class="text-center align-middle">Status</th>
                        <th class="text-center align-middle">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pkl as $p)
                        <tr>
                          <td class="text-center align-middle">{{ $loop->iteration }}</td>
                          <td class="text-center align-middle">{{ $p->nomor_surat }}</td>
                          <td class="text-center align-middle">{{ $p->name }}</td>
                          <td class="text-center align-middle">{{ $p->tempat_pkl }}</td>
                          <td class="text-center align-middle">{{ $p->lama_pkl }}</td>
                          <td class="text-center align-middle">{{ $p->tanggal_mulai }}</td>
                          <td class="text-center align-middle">{{ $p->tanggal_selesai }}</td>
                          <td class="text-center align-middle">
                            <a href="{{ $p->bukti_pembayaran }}" target="_blank" class="btn btn-light m-2">
                              <i class="fas fa-eye"></i>
                            </a>
                          </td>
                          <td class="text-center align-middle">
                            <a href="{{ $p->surat_pernyataan }}" target="_blank" class="btn btn-light m-2">
                              <i class="fas fa-eye"></i>
                            </a>
                          </td>
                          <td class="text-center align-middle">
                            @if ($p->status == 'pending')
                              <span class="badge badge-warning">Pending</span>
                            @elseif ($p->status == 'approve')
                              <span class="badge badge-success">Approved</span>
                            @elseif ($p->status == 'reject')
                              <span class="badge badge-danger">Reject</span>
                            @endif
                          </td>
                          <td class="text-center align-middle">
                            <a href="{{ route('pkl.show', $p->id) }}" class="btn btn-light m-2"><i
                                class="fas fa-eye"></i></a> <br>
                            @if ($p->status == 'approve')
                              <a href="{{ route('pkl.cetak', $p->id) }}" target="_blank" class="btn btn-success m-2"><i
                                  class="fas fa-print"></i></a> <br>
                            @endif
                            @if ($p->status == 'pending')
                              <a href="{{ route('pkl.edit', $p->id) }}" class="btn btn-warning m-2"><i
                                  class="fas fa-edit"></i></a> <br>
                              <form action="{{ route('pkl.approve', $p->id) }}" method="post"
                                onsubmit="return confirm('Apakah yakin menyetujui data ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary m-2" name="status" value="approve"><i
                                    class="fas fa-check"></i></button>
                              </form>
                              <form action="{{ route('pkl.reject', $p->id) }}" method="post"
                                onsubmit="return confirm('Apakah yakin menolak data ini?)">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger m-2"><i class="fas fa-times"></i></button>
                              </form>
                              <form action="{{ route('pkl.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Apakah yakin menghapus data ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-2"><i class="fas fa-trash"></i></button>
                              </form>
                            @endif

                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
