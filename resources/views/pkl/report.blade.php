<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>

    <link rel="icon" type="image" href="https://res.cloudinary.com/ddfstaduo/image/upload/v1710150091/logo/logo-bawaslu_re8djo.png">

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- Load paper.css for happy printing -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}

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
            padding: 7mm;
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
            <img src="https://res.cloudinary.com/dsfa0agbi/image/upload/v1710781601/STIEI/Logo%20Report/biivo3g7noztjetmhycj.png" alt="Logo STIE" style="width: 100px; height: auto; float: left; margin-right: 15px;">
            <!-- Informasi Organisasi -->
            <div class="center-align">
                <h6 style="margin: 7px; font-size: 13px"><b>Yayasan Lembaga Pendidikan Kejuruan Nasional Indonesia (YLPKN) Banjarmasin</b></h6>
                <h1 style="margin: 1px; font-size: 22px;"><b>SEKOLAH TINGGI ILMU EKONOMI INDONESIA (STIE INDONESIA) BANJARMASIN</b></h1>
                <h6 style="margin: 1px; font-size: 10px;">Prodi S1 Manajemen Terakreditasi, Prodi S1 Akuntan Terakreditasi , Prodi S2 Magister Manajemen Terakreditasi</h6>

            </div>
            <!-- Clearfix untuk mengatasi float -->
            <div style="clear: both;"></div>
            <br>
            <hr style="border-top: 3px solid black; margin-top: 0px; margin-bottom: 10px;">
        </div>

        <h1 style="text-align: center; margin-bottom: 0px; text-decoration: underline;">{{ $judul }}</h1>
        <h3 style="text-align: center; margin-top: 0px;">{{ $pkl->nomor_surat }}</h3>

        <div class="content">
            <p><b>Kepada Yth:
                    <br>{{ $pkl->tempat_pkl }}</b></p>
            <p>Dengan Hormat</p>
            <p>Sehubungan dengan rencana Praktek Kerja Lapangan Mahasiswa/i Sekolah Tinggi Ilmu Ekonomi Indonesia (STIE Indonesia) Banjarmasin dan sekaligus menjalin kemitraan antara pendidikan tinggi dengan berbagai Perusahaan pemakai Tenaga Kerja. Maka dimohon kiranya dapat Menerima kami untuk melaksanakan Penelitian.</p>
            <br>
            <p>Adapun Mahasiswa yang dimaksud adalah :
                <br><b>{{ $pkl->name }}.</b></p>
            <br>
            <p>Waktu pelaksanaan Praktek Kerja Lapangan sekitar {{ $pkl->lama_pkl }} yang di harapkan bisa di mulai pada tanggal <b style="text-decoration: underline;">{{ $pkl->tanggal_mulai }} sampai {{ $pkl->tanggal_selesai }}</b> atau di sesuaikan dengan waktu yang di tentukan.</p>


            <p>Demikian disampaikan, kami mengucapkan terima kasih atas kerjasamanya dan kesediaannya menerima Mahasiswa/i kami.</p>


        </div>

        <div style="margin-top: 20px;">
            <div class="left-align" style="float: right; width: 45%;">
                <p>
                    Banjarmasin, {{ $tanggal }}
                    <br>Mengetahui
                </p>
                <br>
                <br>
                <p class="left-align">
                    <b><u>INI NAMA, Ini Gelar</u></b>
                </p>
            </div>
        </div>

        </div>
    </section>

</body>

</html>
