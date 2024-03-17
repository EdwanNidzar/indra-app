<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{ $judul }}</title>

  <link rel="icon" type="image"
    href="https://res.cloudinary.com/ddfstaduo/image/upload/v1710150091/logo/logo-bawaslu_re8djo.png">

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style type="text/css" media="print">
    @page {
      size: auto;
      /* auto is the initial value */
      margin: 0mm;
      /* this affects the margin in the printer settings */
    }
  </style>
  <style>
    body {
      font-family: Calibri, sans-serif;
    }

    .sheet {
      padding: 15mm;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 18px;
      margin-top: 20px;
    }

    .table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      font: normal 13px Arial, sans-serif;
      width: 100%;
      margin-top: 20px;
    }

    .table thead th {
      background-color: #DDEFEF;
      border: solid 1px #DDEEEE;
      color: #336B6B;
      padding: 10px;
      text-align: center;
      text-shadow: 1px 1px 1px #fff;
    }

    .table tbody td {
      border: solid 1px #DDEEEE;
      color: #333;
      padding: 10px;
      text-align: center;
      text-shadow: 1px 1px 1px #fff;
    }

    .table tbody tr {
      page-break-inside: avoid;
      /* Tambahkan ini */
    }

    .left-align {
      text-align: left;
    }
  </style>
</head>

<body>
  <section class="sheet">
    <!-- Header/Kop Surat -->
    <div class="header">
      <!-- Logo -->
      <img src="https://res.cloudinary.com/ddfstaduo/image/upload/v1710150091/logo/logo-bawaslu_re8djo.png"
        alt="Logo BAWASLU" style="width: 90px; height: auto; float: left; margin-right: 30px;">
      <!-- Informasi Organisasi -->
      <div class="left-align">
        <h2 style="margin: 0; font-size: 18px;"><b>Badan Pengawas Pemilihan Umum Provinsi Kalimantan Selatan</b></h2>
        <p style="margin: 5px 0;">Jl. RE Martadinata No.3, Kertak Baru Ilir, Kec. Banjarmasin Tengah,</p>
        <p style="margin: 5px 0;">Kota Banjarmasin, Kalimantan Selatan 70231</p>
        <p style="margin: 5px 0;">Telepon: (0511) 6726 437 | Email: set.kalsel@gmail.go.id</p>
      </div>
      <!-- Clearfix untuk mengatasi float -->
      <div style="clear: both;"></div>
      <br>
      <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
    </div>

    <h1 style="text-align: center;">{{ $judul }}</h1>
    <h3 style="text-align: center;">{{ $mahasiswaaktif->nomor_surat }}</h3>
    <table class="table">
      <thead>
        <tr>
          <th class="text-center align-middle">Nama Mahasiswa</th>
          <th class="text-center align-middle">Tujuan Surat</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center align-middle">{{ $mahasiswaaktif->name }}</td>
          <td class="text-center align-middle">{{ $mahasiswaaktif->tujuan_surat }}</td>
        </tr>
      </tbody>
    </table>
    <div style="margin-top: 20px;">
      <div class="left-align" style="float: right; width: 45%;">
        <p>
          Banjarmasin, {{ $tanggal }}
          <br>Mengetahui
        </p>
        <p class="left-align">
          <b><u>INI NAMA, Ini Gelar</u></b>
        </p>
      </div>
    </div>

    </div>
  </section>

</body>

</html>
