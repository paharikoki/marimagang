@extends('dashboardadmin.pengajuan.layouts.main')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Mahasiswa</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/dashboardadmin/{{ auth()->user()->id }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Permohonan Magang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail</a>
                    </li>
                </ul>
            </div>

            <br>

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <section id="content" class="container">
                <div class="page-heading">
                    <div class="media clearfix">
                        <div class="media-left pr30">
                            <a href="#">
                                @if(!$pengajuan->user->foto)
                                <img class="media-object mw150 rounded-circle shadow" src="https://i.pinimg.com/236x/83/52/64/835264761a076845234005154f1bacd8.jpg" style="width: 150px; height: 150px; background-color:white">
                                @else
                                <img class="media-object mw150 rounded-circle shadow" src="{{ asset('storage/' . $pengajuan->user->foto ) }}" alt="Foto Profil" style="width: 150px; height: 150px;">
                                @endif
                            </a>
                        </div>
                        <div class="media-body va-m" style="margin-left: 25px;">
                            <h2 class="media-heading">{{ $pengajuan->user->nama }}</h2>
                            <p class="lead">Durasi Magang : ( {{ $pengajuan->tanggalmulai }} - {{ $pengajuan->tanggalselesai }} )</p>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#emailModal">
                                Gmail
                            </button>

                            <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="emailModalLabel">Kirim Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="/kirim-email">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="email">Email Ke:</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $pengajuan->user->email }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pesan">Pesan:</label>
                                                    <textarea class="form-control" id="my-editor" name="pesan" rows="5" placeholder="Masukkan pesan Anda di sini"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="submit" class="btn btn-success">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-trophy"></i>
                                </span>
                                <span class="panel-title">Skill</span>
                            </div>
                            <div class="panel-body pb5">
                                @foreach ($pengajuan->skilluser as $skill)
                                <span class="label label-success mr5 mb10 ib lh15">{{ $skill->skill->nama }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <span class="panel-title">Project Sebelumnya</span>
                            </div>
                            <div class="panel-body pb5">
                                <h6>Pengalaman Sebelumnya</h6>
                                <p class="text-muted">{{ $pengajuan->deskripsi }}</p>
                                <hr class="short br-lighter">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank" class="btn btn-info btn-sm btn-block">
                                            Lihat
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ asset('storage/' . $pengajuan->bukti) }}" download class="btn btn-success btn-sm btn-block">
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">

                        <div class="tab-block">
                            <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab1" data-toggle="tab" onclick="activateTab('tab1')">Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab" onclick="activateTab('tab2')">Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab" onclick="activateTab('tab3')">Pengajuan</a>
                                </li>
                                @if ($pengajuan->status == 'Magang' || $pengajuan->status == 'Selesai')
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab4" data-toggle="tab" onclick="activateTab('tab4')">Logbook</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab5" data-toggle="tab" onclick="activateTab('tab5')">Nilai</a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content p30" style="height: 730px;">
                                <div id="tab1" class="tab-pane active">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->nama }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->email }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Asal Kampus</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->kampus }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $pengajuan->user->nim }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Jurusan</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->jurusan->nama_jurusan }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Prodi</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->prodi->nama_prodi }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nomor Telepon</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ $pengajuan->user->telepon }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane">
                                    @foreach ($anggota as $anggota)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $anggota->nama }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $anggota->nim }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="tab3" class="tab-pane">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Pengantar Pendidikan</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->pengantar)
                                                    <a href="{{ asset('storage/' . $pengajuan->pengantar) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->pengantar) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Proposal</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->proposal)
                                                    <a href="{{ asset('storage/' . $pengajuan->proposal) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->proposal) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> CV</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->cv)
                                                    <a href="{{ asset('storage/' . $pengajuan->cv) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->cv) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Surat Kesbangpol</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->kesbangpol)
                                                    <a href="{{ asset('storage/' . $pengajuan->kesbangpol) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->kesbangpol) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Surat Kesediaan Magang</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->kesediaan)
                                                    <a href="{{ asset('storage/' . $pengajuan->kesediaan) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->kesediaan) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Laporan Magang</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->laporan)
                                                    <a href="{{ asset('storage/' . $pengajuan->laporan) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->laporan) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Surat Selesai Magang</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->suratmagang)
                                                    <a href="{{ asset('storage/' . $pengajuan->suratmagang) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $pengajuan->suratmagang) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab4" class="tab-pane">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @foreach($tanggallogbook as $tanggal)
                                            @php
                                            $logbookEntries = $logbook->where('tanggal', $tanggal);
                                            $tglBgColor = $logbookEntries->isNotEmpty() ? 'background-color: #f25961;' : ''; // Jika ada entri logbook, beri latar belakang merah
                                            $tglTextColor = $logbookEntries->isNotEmpty() ? 'color: white;' : ''; // Jika ada entri logbook, ubah warna teks menjadi putih
                                            @endphp
                                            <div class="tgl-row" style="margin-bottom: 20px;">
                                                <div class="tgl-header" onclick="toggleLogbook(this)" style="{{ $tglBgColor }}">
                                                    <p class="tgl-date" style="{{ $tglTextColor }}">{{ \Carbon\Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</p>
                                                    <i class="fas fa-chevron-down" style="{{ $tglTextColor }}"></i>
                                                </div>
                                                <div class="tgl-content" style="display: none;">
                                                    @if($logbookEntries->isNotEmpty())
                                                    @foreach($logbookEntries as $log)
                                                    <div class="isi-logbook">
                                                        <p>{{ $log->kegiatan }}</p>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p class="text-muted">Tidak ada entri logbook untuk tanggal ini.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="tab5" class="tab-pane">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="mb-0"><i class="fa fa-file-pdf-o"></i> Nilai Magang</p>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    @if ($pengajuan->nilai)
                                                    <a href="{{ asset('storage/' . $pengajuan->nilai) }}" download class="btn btn-sm btn-success rounded-circle">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    @else
                                                    <p class="text-muted mb-0">File Belum Tersedia</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    function toggleLogbook(element) {
        var content = element.nextElementSibling;
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endpush