<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1;
        margin: 1.38cm;
        padding: 0;

    }

    table,
    tr,
    td {
        border: 1px solid white;
    }


    .header {
        width: 100%;
        text-align: center;
    }

    .logo {
        width: 2.2cm;
        height: auto;
    }

    .italic {
        font-style: italic;
    }

    .conten1 {
        width: 100%;
        text-align: center;
    }

    .h1 {
        font-size: 18pt;
    }

    .h2 {
        font-size: 16pt;
    }

    .h3 {
        font-size: 14pt;
    }

    .h4 {
        font-size: 12pt;
    }

    .h5 {
        font-size: 11pt;
    }

    .h6 {
        font-size: 10pt;
    }

    .fw-bold {
        font-weight: bold;
    }

    .fw-normal {
        font-weight: normal;
    }

    th {
        text-align: left;
        width: 150px;
    }

    .justify {
        text-align: justify;
    }

    .ttd {
        text-align: center;
    }

    pre {
        font-family: Arial, Helvetica, sans-serif;
    }

    .t-center{
        text-align: center;
    }
</style>

<body>
    <table class="header">
        @php
        $path = public_path('assets/images/kab_malang.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <tr>
            <td rowspan="5" class="t-center"><img src="{{ $base64 }}" class="logo" alt="Logo"></td>
            <td class="h2 fw-bold">PEMERINTAH KABUPATEN MALANG</td>
        </tr>
        <tr>
            <td class="h1 fw-bold">DINAS KOMUNIKASI DAN INFORMATIKA</td>
        </tr>
        <tr>
            <td class="h5">Jl. K.H Agus Salim No 7 Gedung J Malang Telepon ( 0341 ) 408788</td>
        </tr>
        <tr>
            <td class="h5 italic">Email: kominfo@malangkab.go.id - Website: <a href="">www.malangkab.go.id</a></td>
        </tr>
        <tr>
            <td>M A L A N G 65126</td>
        </tr>
    </table>
    <hr>
    <br>
    <div>
        <table class="conten1">
            <tr>
                <td class="h3 fw-bold"><u>SURAT KETERANGAN</u></td>
            </tr>
            <tr>
                <td>Nomor : <span>{{ $nomor_surat }}</span></td>
            </tr>
        </table>
    </div>
    <pre>
        Yang bertanda tangan di bawah ini :
    </pre>
    <div>
        <table style="line-height: 1.5;">
            <tr>
                <th class="fw-normal">Nama</th>
                <td>:</td>
                <td class="fw-bold">{{ $nama_petugas }}</td>
            </tr>
            <tr>
                <th class="fw-normal">NIP</th>
                <td>:</td>
                <td class="fw-bold">{{ $nip }}</td>
            </tr>
            <tr>
                <th class="fw-normal">Jabatan</th>
                <td>:</td>
                <td class="fw-bold">{{ $jabatan }}</td>
            </tr>
        </table>
    </div>
    <pre>
        Menerangkan Bahwa :
    </pre>
    <div>
        <table style="line-height: 1.5;">
            @php
            $no = 1; // Inisialisasi variabel nomor urut
            @endphp
            <tr>
                <td>{{ $no++ }}.</td>
                <th class="fw-normal">Nama</th>
                <td>:</td>
                <td class="fw-bold">{{ $user->nama }}</td>
            </tr>
            <tr>
                <td></td>
                <th class="fw-normal">NIM</th>
                <td>:</td>
                <td class="fw-bold">{{ $user->nim }}</td>
            </tr>
            @foreach ($anggota as $anggotaItem)
            <tr>
                <td>{{ $no++ }}.</td>
                <th class="fw-normal">Nama</th>
                <td>:</td>
                <td class="fw-bold">{{ $anggotaItem->nama }}</td>
            </tr>

            <tr>
                <td></td>
                <th class="fw-normal">NIM</th>
                <td>:</td>
                <td class="fw-bold">{{ $anggotaItem->nim }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <br>
    <div>
        <table style="line-height: 1.5;">
            <tr>
                <th class="fw-normal">Program Studi</th>
                <td>:</td>
                <td class="fw-bold">{{ $prodi }}</td>
            </tr>
            <tr>
                <th class="fw-normal">Fakultas / Jurusan</th>
                <td>:</td>
                <td class="fw-bold">{{ $jurusan }}</td>
            </tr>
            <tr>
                <th class="fw-normal">Asal Universitas</th>
                <td>:</td>
                <td class="fw-bold">{{ $kampus }}</td>
            </tr>
        </table>
    </div>
    <p class="justify" style="line-height: 1.5;">
        Dapat melaksanakan Kegiatan Magang dengan nama kegiatan “<span class="fw-bold">{{ $judul_kegiatan }}</span>” di {{ $bidang }} Dinas Komunikasi dan Informatika Kabupaten Malang pada {{ $tanggalmulai }} s/d {{ $tanggalselesai }}.
    </p>
    <pre>
        Demikian surat keterangan ini untuk dipergunakan sebagaimana mestinya.
    </pre>
    <div style="padding-left: 250px;">
        <table class="ttd">
            <tr>
                <td>
                    Malang, {{ $tanggal }}

                </td>
            </tr>
            <tr>
                <td class="fw-bold"  style="text-align: center;">
                    an. Kepala Dinas Komunikasi dan Informatika <br>
                    Sekretaris,
                </td>
            </tr>
            <tr>
                <td
                    style="height: 100px;">
                </td>
            </tr>
            <tr>
                <td class="fw-bold"><u>{{ $nama_petugas }}</u></td>
            </tr>
            <tr>
                <td class="fw-bold">Pembina Tk. I</td>
            </tr>
            <tr>
                <td>{{ $nip }}</td>
            </tr>
        </table>
    </div>
</body>

</html>