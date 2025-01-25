    @extends('mahasiswa.layouts.mainupload')

    @section('content')
        <div class="container-fluid px-0" id="bg-div">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="card card0">
                        <div class="d-flex" id="wrapper">
                            <!-- Menu Sidebar -->
                            <div class="bg-light border-right" id="sidebar-wrapper">
                                <div class="sidebar-heading pt-5 pb-4">
                                    <strong>MENU</strong>
                                </div>
                                <div class="list-group list-group-flush">
                                    @php
                                        $activeTab = '';

                                        foreach ($pengajuan as $p) {
                                            if (
                                                $p->status == 'Diproses' ||
                                                $p->status == 'Diteruskan' ||
                                                $p->status == 'Diterima' ||
                                                $p->status == 'Magang'
                                            )
                                            {
                                                $activeTab = 'menu5';
                                                break;
                                            }
                                        }
                                    @endphp

                                    @if ($activeTab != 'menu5')
                                        <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item">
                                            <div class="list-div my-2">
                                                <div class="fa fa-home"></div> &nbsp;&nbsp; Pengajuan Magang
                                            </div>
                                        </a>
                                    @endif

                                    @foreach ($pengajuan as $p)
                                        @if (!$p->kesbangpol)
                                            <a data-toggle="tab" href="#menu7" id="tab2"
                                                class="tabs list-group-item bg-light">
                                                <div class="list-div my-2">
                                                    <div class="fa fa-upload"></div> &nbsp;&nbsp;&nbsp; Surat Kesbangpol
                                                </div>
                                            </a>
                                        @endif
                                        @if ($p->status == 'Magang' && !$p->kesbangpol)
                                            <a data-toggle="tab" href="#menu2" id="tab2"
                                                class="tabs list-group-item bg-light">
                                                <div class="list-div my-2">
                                                    <div class="fa fa-upload"></div> &nbsp;&nbsp;&nbsp; Surat Kesbangpol
                                                </div>
                                            </a>
                                        @elseif ($p->status == 'Magang' && $p->kesbangpol)
                                            <a data-toggle="tab" href="#menu3" id="tab3"
                                                class="tabs list-group-item bg-light">
                                                <div class="list-div my-2">
                                                    <div class="fa fa-upload"></div> &nbsp;&nbsp;&nbsp; Logbook Mahasiswa
                                                </div>
                                            </a>
                                            <a data-toggle="tab" href="#menu4" id="tab4"
                                                class="tabs list-group-item bg-light">
                                                <div class="list-div my-2">
                                                    <div class="fa fa-upload"></div> &nbsp;&nbsp;&nbsp; Laporan Akhir
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                    <a data-toggle="tab" href="#menu5" id="tab5"
                                        class="tabs list-group-item bg-light @if ($activeTab == 'menu5') active1 @endif">
                                        <div class="list-div my-2">
                                            <div class="fa fa-history"></div> &nbsp;&nbsp;&nbsp; Riwayat Pengajuan
                                        </div>
                                    </a>
                                    <a data-toggle="tab" href="#menu6" id="tab6"
                                        class="tabs list-group-item bg-light">
                                        <div class="list-div my-2">
                                            <div class="fa fa-clipboard"></div> &nbsp;&nbsp;&nbsp; Survei Kepuasan
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div id="page-content-wrapper">
                                <div class="row pt-3" id="border-btm">
                                    <div class="col-4">
                                        <button class="btn btn-primary mt-4 ml-3 mb-3" id="menu-toggle">
                                            <div class="bar4"></div>
                                            <div class="bar4"></div>
                                            <div class="bar4"></div>
                                        </button>
                                    </div>
                                    <div class="col-8">
                                        <div class="row justify-content-right">
                                            <div class="col-12">
                                                <p class="mb-0 mr-4 mt-4 text-right" style="font-weight: bold;">
                                                    {{ $user->nama }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-right">
                                            <div class="col-12">
                                                <p class="mb-0 mr-4 text-right">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                </div>

                                <div class="tab-content">

                                    <!-- Menu Pengajuan Mahasiswa -->
                                    <div id="menu1" class="tab-pane @if ($activeTab != 'menu5') in active @endif">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <div class="form-card">
                                                    <h4 class="mt-0 mb-4 text-center">FORM PENGAJUAN MAGANG</h4>
                                                    <div class="main">

                                                        <div class="container">
                                                            <form method="POST" id="pengajuan-form" class="pengajuan-form"
                                                                enctype="multipart/form-data"
                                                                action="{{ route('pengajuan.submit') }}">
                                                                @csrf
                                                                <h3>
                                                                    Data Umum
                                                                </h3>
                                                                <fieldset>
                                                                    <div class="form-group" style="width: 100%;">
                                                                        <label for="name">Nama Lengkap:</label>
                                                                        <input type="text" name="display_name"
                                                                            id="display_name" value="{{ $user->nama }}"
                                                                            disabled />
                                                                        <input type="hidden" name="user_id" id="user_id"
                                                                            value="{{ $user->id }}" />
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group">
                                                                            <label for="start_date">Tanggal Mulai
                                                                                Magang:</label>
                                                                            <input type="date" name="start_date"
                                                                                id="start_date" min="{{ date('Y-m-d') }}"
                                                                                class="form-control form-control-user @error('start_date') is-invalid @enderror"
                                                                                value="{{ old('start_date') }}" />
                                                                            @error('start_date')
                                                                                <div class="invalid-feedback"
                                                                                    style="margin-top: -20px;">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="end_date">Tanggal Selesai
                                                                                Magang:</label>
                                                                            <input type="date" name="end_date"
                                                                                id="end_date" min="{{ date('Y-m-d') }}"
                                                                                class="form-control form-control-user @error('end_date') is-invalid @enderror"
                                                                                value="{{ old('end_date') }}" />
                                                                            @error('end_date')
                                                                                <div class="invalid-feedback"
                                                                                    style="margin-top: -20px;">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-select">
                                                                            <label for="databidang">Pilih Bidang
                                                                                Kerja</label>
                                                                            <div class="select-group">
                                                                                <select name="databidang_id"
                                                                                    id="databidang"
                                                                                    class="form-control form-control-user @error('databidang_id') is-invalid @enderror">
                                                                                    <option value="" disabled
                                                                                        selected hidden></option>
                                                                                    @foreach ($databidang as $bidang)
                                                                                        <option
                                                                                            value="{{ $bidang->id }}">
                                                                                            {{ $bidang->nama }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('databidang_id')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-select">
                                                                            <label for="skill">Pilih Skill</label>
                                                                            <div class="select-group">
                                                                                <select name="skill[]" id="skill"
                                                                                    multiple="multiple"
                                                                                    class="form-control form-control-user @error('skill') is-invalid @enderror">
                                                                                </select>
                                                                                @error('skill')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <h3>
                                                                    Portofolio
                                                                </h3>
                                                                <fieldset>
                                                                    <div class="form-row">
                                                                        <div class="form-group" style="width: 100%;">
                                                                            <label for="bukti">Bukti Project
                                                                                (pdf):</label>
                                                                            <input type="file" name="bukti"
                                                                                id="bukti" accept=".pdf"
                                                                                class="form-control form-control-user @error('bukti') is-invalid @enderror" />
                                                                            @error('bukti')
                                                                                <div class="invalid-feedback"
                                                                                    style="margin-top: -20px;">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form">
                                                                        <label for="deskripsi">Deskripsi Project:</label>
                                                                        <textarea id="deskripsi" name="deskripsi" style="resize: none; width: 100%; height:230px;"
                                                                            class="form-control form-control-user @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                                                        @error('deskripsi')
                                                                            <div class="invalid-feedback"
                                                                                style="margin-top: -20px;">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </fieldset>

                                                                <h3>
                                                                    Upload Berkas
                                                                </h3>
                                                                <fieldset>
                                                                    <div class="container mt-5">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="proposal">Proposal
                                                                                    Magang:</label>
                                                                                <div class="upload-box" id="left-box">
                                                                                    <p>Drag & Drop PDF</p>
                                                                                    <br>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">Pilih
                                                                                        File</button>
                                                                                    <input type="file" id="proposal"
                                                                                        name="proposal" accept=".pdf"
                                                                                        style="display: none;"
                                                                                        class="form-control form-control-user @error('proposal') is-invalid @enderror">
                                                                                    @error('proposal')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div id="proposal-info"></div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="pengantar">Surat
                                                                                    Pengantar:</label>
                                                                                <div class="upload-box" id="center-box">
                                                                                    <p>Drag & Drop PDF</p>
                                                                                    <br>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">Pilih
                                                                                        File</button>
                                                                                    <input type="file" id="pengantar"
                                                                                        name="pengantar" accept=".pdf"
                                                                                        style="display: none;"
                                                                                        class="form-control form-control-user @error('pengantar') is-invalid @enderror">
                                                                                    @error('pengantar')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div id="pengantar-info"></div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="cv">Curicullum
                                                                                    Vitae:</label>
                                                                                <div class="upload-box" id="right-box">
                                                                                    <p>Drag & Drop PDF</p>
                                                                                    <br>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">Pilih
                                                                                        File</button>
                                                                                    <input type="file" id="cv"
                                                                                        name="cv" accept=".pdf"
                                                                                        style="display: none;"
                                                                                        class="form-control form-control-user @error('cv') is-invalid @enderror">
                                                                                    @error('cv')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div id="cv-info"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Kirim</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($pengajuan as $p)
                                    @if (!$p->kesbangpol)
                                        <!-- Menu Upload Surat Kesbangpol -->
                                        <div id="menu7" class="tab-pane @if ($activeTab == 'menu7') in active @endif">
                                            <div class="row justify-content-center">
                                                <div class="col-11">
                                                    <h4 class="mt-2  text-center">UPLOAD SURAT KESBANGPOL</h4>
                                                    <div class="row justify-content-center">
                                                        <div class="container mt-0">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center font-weight-bold">Ikuti Pedoman ini</h5>
                                                                    <hr>
                                                                    <p>1. Silakan download surat di link ini <a href="#">Download Surat Kesbangpol</a></p>
                                                                    <p>2. Silakan ke kantor Kesbangpol Kabupaten Malang</p>
                                                                    <p>3. Scan surat yang sudah mempunyai cap dari Kesbangpol</p>
                                                                    <p>4. Upload scan surat di bawah ini</p>
                                                                </div>
                                                            </div>
                                                            <form class="p-4" method="POST"
                                                                action="{{ route('kesbangpol.submit') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $p->id }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $p->user_id }}">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="upload-box " style="max-height: 350px" id="kesbangpol-box">
                                                                            <p>Drag & Drop PDF</p>
                                                                            <br>
                                                                            <button type="button"
                                                                                class="btn btn-danger">Pilih
                                                                                File</button>
                                                                            <input type="file" id="kesbangpol"
                                                                                name="kesbangpol" accept=".pdf"
                                                                                style="display: none;">
                                                                        </div>
                                                                        <div id="kesbangpol-info"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-end mt-3">
                                                                    <div class="col-md-2">
                                                                        <button type="submit" id="submit-btn"
                                                                            class="btn btn-danger btn-block"
                                                                            style="display: none;">Kirim</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else

                                    @endif
                                        @if ($p->status == 'Magang' && !$p->kesbangpol)
                                            <!-- Menu Upload Surat Kesbangpol -->
                                            <div id="menu2" class="tab-pane">
                                                <div class="row justify-content-center">
                                                    <div class="col-11">
                                                        <h4 class="mt-0 mb-2 text-center">UPLOAD SURAT KESBANGPOL</h4>
                                                        <div class="row justify-content-center">
                                                            <div class="container mt-0">
                                                                <form method="POST"
                                                                    action="{{ route('kesbangpol.submit') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $p->id }}">
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $p->user_id }}">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="upload-box" id="kesbangpol-box">
                                                                                <p>Drag & Drop PDF</p>
                                                                                <br>
                                                                                <button type="button"
                                                                                    class="btn btn-danger">Pilih
                                                                                    File</button>
                                                                                <input type="file" id="kesbangpol"
                                                                                    name="kesbangpol" accept=".pdf"
                                                                                    style="display: none;">
                                                                            </div>
                                                                            <div id="kesbangpol-info"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-end mt-3">
                                                                        <div class="col-md-2">
                                                                            <button type="submit" id="submit-btn"
                                                                                class="btn btn-danger btn-block"
                                                                                style="display: none;">Kirim</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($p->status == 'Magang' && $p->kesbangpol)
                                            <!-- Menu Logbook Mahasiswa -->
                                            <div id="menu3" class="tab-pane" style="padding: 20px;">
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-11">
                                                            <div
                                                                style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); padding: 30px; text-align: center; animation: fadeInUp 0.8s ease-in-out;">
                                                                <h4
                                                                    style="color: black; font-size: 24px; margin-bottom: 20px;">
                                                                    LOGBOOK MAHASISWA</h4>
                                                                <a href="/logbook/{{ $user->id }}?id_pengajuan={{ $p->id }}"
                                                                    style="display: inline-block; padding: 15px 30px; font-size: 18px; text-decoration: none; color: #ffffff; background-color: #DC143C; border-radius: 5px; transition: background-color 0.3s ease; cursor: pointer;"
                                                                    onmouseover="this.style.backgroundColor='#DC143C'"
                                                                    onmouseout="this.style.backgroundColor='#DC143C'">Isi
                                                                    Logbook</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Menu Upload Laporan Akhir -->
                                            <div id="menu4" class="tab-pane">
                                                <div class="row justify-content-center">
                                                    <div class="col-11">
                                                        <h4 class="mt-0 mb-2 text-center">UPLOAD LAPORAN AKHIR</h4>
                                                        <div class="row justify-content-center">
                                                            <div class="container mt-0">
                                                                <form method="POST"
                                                                    action="{{ route('laporan.submit') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $p->id }}">
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $p->user_id }}">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <label for="dokumentasi"
                                                                                class="form-label">Upload Dokumentasi
                                                                                (.img):</label>
                                                                            <input type="file" id="dokumentasi"
                                                                                name="dokumentasi" accept="image/*"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <label for="nilai"
                                                                                class="form-label">Upload Form Nilai (.docx
                                                                                / .doc):</label>
                                                                            <input type="file" id="nilai"
                                                                                name="nilai" accept=".docx"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="laporan"
                                                                                class="form-label">Upload Laporan Akhir
                                                                                (.pdf):</label>
                                                                            <br>
                                                                            <small><b>*pastikan surat kesbangpol sudah
                                                                                    diupload dan pastikan logbook sudah
                                                                                    terisi lengkap</b></small>
                                                                            <div class="upload-box" id="laporan-box">
                                                                                <p>Drag & Drop PDF</p>
                                                                                <br>
                                                                                <button type="button"
                                                                                    class="btn btn-danger">Pilih
                                                                                    File</button>
                                                                                <input type="file" id="laporan"
                                                                                    name="laporan" accept=".pdf"
                                                                                    style="display: none;">
                                                                            </div>
                                                                            <div id="laporan-info"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-end mt-3">
                                                                        <div class="col-md-2">
                                                                            <button type="submit" id="submit-btn"
                                                                                class="btn btn-danger btn-block"
                                                                                style="display: none;">Kirim</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                    @endforeach

                                    <!-- Menu Riwayat Pengajuan -->
                                    <div id="menu5"
                                        class="tab-pane @if ($activeTab == 'menu5') in active @endif">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <h4 class="mt-0 mb-4 text-center">RIWAYAT PENGAJUAN MAGANG</h4>
                                                <div class="row justify-content-center">
                                                    <div class="scrolling-container">
                                                        @foreach ($pengajuan as $p)
                                                            <div class="card mb-3" style="width: 600px;">
                                                                <div
                                                                    class="card-header d-flex justify-content-between align-items-center toggle-card">
                                                                    <div>
                                                                        <b style="margin-right: 5px;">Permohonan Magang
                                                                            :</b>
                                                                        <span
                                                                            class="badge
                                                                @if ($p->status == 'Diproses') badge-warning
                                                                @elseif($p->status == 'Diteruskan') badge-info
                                                                @elseif($p->status == 'Diterima') badge-success
                                                                @elseif($p->status == 'Ditolak') badge-danger
                                                                @elseif($p->status == 'Magang') badge-primary
                                                                @elseif($p->status == 'Selesai') badge-dark @endif">
                                                                            {{ $p->status }}
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <button type="button" class="btn btn-link"
                                                                            data-toggle="collapse"
                                                                            data-target="#detail-{{ $p->id }}">
                                                                            <i class="fas fa-caret-down"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div id="detail-{{ $p->id }}"
                                                                    class="collapse card-body">
                                                                    <ul class="alignMe" style="list-style: none;">
                                                                        <li><b>Tanggal Mulai</b> {{ $p->tanggalmulai }}
                                                                        </li>
                                                                        <li><b>Tanggal Selesai</b> {{ $p->tanggalselesai }}
                                                                        </li>
                                                                        <li><b>Bidang</b> {{ $p->databidang->nama }}</li>
                                                                        <li>
                                                                            <b>Surat Pengantar Pendidikan</b>
                                                                            <a href="{{ asset('storage/' . $p->pengantar) }}"
                                                                                target="_blank" class="text-danger">
                                                                                <span style="margin-right: 5px;">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </span>
                                                                                Lihat
                                                                            </a>
                                                                            |
                                                                            <a href="{{ asset('storage/' . $p->pengantar) }}"
                                                                                download class="text-danger">
                                                                                <span style="margin-left: 5px;">
                                                                                    <i class="fas fa-download"></i>
                                                                                </span>
                                                                                Download
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <b>Proposal Magang</b>
                                                                            <a href="{{ asset('storage/' . $p->proposal) }}"
                                                                                target="_blank" class="text-danger">
                                                                                <span style="margin-right: 5px;">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </span>
                                                                                Lihat
                                                                            </a>
                                                                            |
                                                                            <a href="{{ asset('storage/' . $p->proposal) }}"
                                                                                download class="text-danger">
                                                                                <span style="margin-left: 5px;">
                                                                                    <i class="fas fa-download"></i>
                                                                                </span>
                                                                                Download
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <b>Curriculum vitae</b>
                                                                            <a href="{{ asset('storage/' . $p->cv) }}"
                                                                                target="_blank" class="text-danger">
                                                                                <span style="margin-right: 5px;">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </span>
                                                                                Lihat
                                                                            </a>
                                                                            |
                                                                            <a href="{{ asset('storage/' . $p->cv) }}"
                                                                                download class="text-danger">
                                                                                <span style="margin-left: 5px;">
                                                                                    <i class="fas fa-download"></i>
                                                                                </span>
                                                                                Download
                                                                            </a>
                                                                        </li>
                                                                        @if (in_array($p->status, ['Diterima', 'Magang', 'Selesai']))
                                                                            @if ($p->kesediaan)
                                                                                <li>
                                                                                    <b>Surat Rekomendasi Magang</b>
                                                                                    <a href="{{ asset('storage/' . $p->kesediaan) }}"
                                                                                        target="_blank"
                                                                                        class="text-danger">
                                                                                        <span style="margin-right: 5px;">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </span>
                                                                                        Lihat
                                                                                    </a>
                                                                                    |
                                                                                    <a href="{{ asset('storage/' . $p->kesediaan) }}"
                                                                                        download class="text-danger">
                                                                                        <span style="margin-left: 5px;">
                                                                                            <i class="fas fa-download"></i>
                                                                                        </span>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                            @endif
                                                                            @if ($p->laporan)
                                                                                <li>
                                                                                    <b>Laporan Akhir</b>
                                                                                    <a href="{{ asset('storage/' . $p->laporan) }}"
                                                                                        target="_blank"
                                                                                        class="text-danger">
                                                                                        <span style="margin-right: 5px;">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </span>
                                                                                        Lihat
                                                                                    </a>
                                                                                    |
                                                                                    <a href="{{ asset('storage/' . $p->laporan) }}"
                                                                                        download class="text-danger">
                                                                                        <span style="margin-left: 5px;">
                                                                                            <i class="fas fa-download"></i>
                                                                                        </span>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                            @endif
                                                                            @if ($p->suratmagang)
                                                                                <li>
                                                                                    <b>Surat Selesai Magang</b>
                                                                                    <a href="{{ asset('storage/' . $p->suratmagang) }}"
                                                                                        target="_blank"
                                                                                        class="text-danger">
                                                                                        <span style="margin-right: 5px;">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </span>
                                                                                        Lihat
                                                                                    </a>
                                                                                    |
                                                                                    <a href="{{ asset('storage/' . $p->suratmagang) }}"
                                                                                        download class="text-danger">
                                                                                        <span style="margin-left: 5px;">
                                                                                            <i class="fas fa-download"></i>
                                                                                        </span>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            @if ($p->nilai)
                                                                                <li>
                                                                                    <b>Nilai Magang</b>
                                                                                    <a href="{{ asset('storage/' . $p->nilai) }}"
                                                                                        download class="text-danger">
                                                                                        <span style="margin-left: 5px;">
                                                                                            <i class="fas fa-download"></i>
                                                                                        </span>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            <li>
                                                                                <b>Kesbangpol</b>
                                                                                @if ($p->kesbangpol)
                                                                                    <a href="{{ asset('storage/' . $p->kesbangpol) }}"
                                                                                        target="_blank"
                                                                                        class="text-danger">
                                                                                        <span style="margin-right: 5px;">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </span>
                                                                                        Lihat
                                                                                    </a>
                                                                                    |
                                                                                    <a href="{{ asset('storage/' . $p->kesbangpol) }}"
                                                                                        download class="text-danger">
                                                                                        <span style="margin-left: 5px;">
                                                                                            <i class="fas fa-download"></i>
                                                                                        </span>
                                                                                        Download
                                                                                    </a>
                                                                                @else
                                                                                    File Belum Diupload
                                                                                @endif
                                                                            </li>
                                                                        @endif
                                                                        @if ($p->status == 'Magang' || $p->status == 'Ditolak')
                                                                            <li>
                                                                                <b>Komentar</b>
                                                                                <a href="#" data-toggle="modal"
                                                                                    data-target="#komentarModal{{ $p->id }}"
                                                                                    class="text-danger">
                                                                                    <span style="margin-right: 5px;">
                                                                                        <i class="fas fa-eye"></i>
                                                                                    </span>
                                                                                    Lihat
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        <li>
                                                                            <b>Data Anggota</b>
                                                                            <a href="/anggota/{{ $user->id }}?id_pengajuan={{ $p->id }}"
                                                                                class="text-danger">
                                                                                <span style="margin-right: 5px;">
                                                                                    <i class="fas fa-users"></i>
                                                                                </span>
                                                                                Kelola Data Anggota
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <!-- Modal Untuk Komentar -->
                                                                <div class="modal fade"
                                                                    id="komentarModal{{ $p->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="exampleModalLongTitle"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">Komentar
                                                                                    Terkait Pengajuan</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{!! $p->komentar !!}</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Tutup</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Menu Survei Kepuasan -->
                                    <div id="menu6" class="tab-pane" style="padding: 20px;">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-11">
                                                    <div
                                                        style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); padding: 30px; text-align: center; animation: fadeInUp 0.8s ease-in-out;">
                                                        <h4 style="color: black; font-size: 24px; margin-bottom: 20px;">
                                                            SURVEI KEPUASAN MASYARAKAT</h4>
                                                        <a href="https://sukma.jatimprov.go.id/fe/survey?idUser=1992"
                                                            style="display: inline-block; padding: 15px 30px; font-size: 18px; text-decoration: none; color: #ffffff; background-color: #DC143C; border-radius: 5px; transition: background-color 0.3s ease; cursor: pointer;"
                                                            onmouseover="this.style.backgroundColor='#DC143C'"
                                                            onmouseout="this.style.backgroundColor='#DC143C'">Isi
                                                            Survei</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection

    @push('script')
        <!-- JS Mengatur Select Skill Terkait Databidang -->
        <script>
            $(document).ready(function() {

                $('#databidang').select2({
                    width: '100%',
                });
                $('#skill').select2({
                    width: '100%',
                });

                $('#databidang').on('change', function() {
                    $('#skill').empty();
                    var databidang_id = $(this)
                        .val();
                    $.get("{{ url('/pengajuan/pilihan-skill') }}/" + databidang_id, function(data, status) {

                        $("#skill").select2({
                            data: data.results,
                            width: '100%',
                        })
                    });
                });
            });
        </script>

        <!-- JS Mengatur Card -->
        <script>
            $(document).ready(function() {
                $('.toggle-card').click(function() {
                    var cardBody = $(this).siblings('.card-body');
                    cardBody.slideToggle();
                });
            });
        </script>

        <!-- JS Mengatur File Upload Kesbangpol -->
        <script>
            const kesbangpolBox = document.getElementById('kesbangpol-box');
            const kesbangpolInfo = document.getElementById('kesbangpol-info');

            kesbangpolBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                kesbangpolBox.style.border = '2px dashed #007bff';
            });

            kesbangpolBox.addEventListener('dragleave', () => {
                kesbangpolBox.style.border = '2px dashed #ccc';
            });

            kesbangpolBox.addEventListener('drop', (e) => {
                e.preventDefault();
                kesbangpolBox.style.border = '2px dashed #ccc';
                const file = e.dataTransfer.files[0];
                handleUploadedFile(file, kesbangpolInfo, 'kesbangpol');
            });

            kesbangpolBox.addEventListener('click', () => {
                document.getElementById('kesbangpol').click();
            });

            document.getElementById('kesbangpol').addEventListener('change', function(e) {
                const file = e.target.files[0];
                handleUploadedFile(file, kesbangpolInfo, 'kesbangpol');
            });

            function handleUploadedFile(file, infoContainer, type) {
                const submitBtn = document.getElementById('submit-btn');

                if (file.type === 'application/pdf') {
                    infoContainer.innerHTML =
                        `<p><i class="fas fa-file-pdf pdf-icon"></i> ${file.name} <span class="remove-file" onclick="removeFile('${type}')">×</span></p>`;
                    submitBtn.style.display = 'block';
                } else {
                    infoContainer.innerHTML = '<p>File Harus Berformat PDF.</p>';
                    submitBtn.style.display = 'none';
                }
            }
        </script>

        <!-- JS Mengatur File Upload Laporan -->
        <script>
            const laporanBox = document.getElementById('laporan-box');
            const laporanInfo = document.getElementById('laporan-info');

            laporanBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                laporanBox.style.border = '2px dashed #007bff';
            });

            laporanBox.addEventListener('dragleave', () => {
                laporanBox.style.border = '2px dashed #ccc';
            });

            laporanBox.addEventListener('drop', (e) => {
                e.preventDefault();
                laporanBox.style.border = '2px dashed #ccc';
                const file = e.dataTransfer.files[0];
                handleUploadedFile(file, laporanInfo, 'laporan');
            });

            laporanBox.addEventListener('click', () => {
                document.getElementById('laporan').click();
            });

            document.getElementById('laporan').addEventListener('change', function(e) {
                const file = e.target.files[0];
                handleUploadedFile(file, laporanInfo, 'laporan');
            });

            function handleUploadedFile(file, infoContainer, type) {
                const submitBtn = document.getElementById('submit-btn');

                if (file.type === 'application/pdf') {
                    infoContainer.innerHTML =
                        `<p><i class="fas fa-file-pdf pdf-icon"></i> ${file.name} <span class="remove-file" onclick="removeFile('${type}')">×</span></p>`;
                    submitBtn.style.display = 'block';
                } else {
                    infoContainer.innerHTML = '<p>File Harus Berformat PDF.</p>';
                    submitBtn.style.display = 'none';
                }
            }
        </script>
    @endpush
