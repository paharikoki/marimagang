@extends('mahasiswa.layouts.main')

@section('content')



<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Selamat Datang</h2>
                <h6>Mahasiswa Seluruh Indonesia</h6>
            </div>
        </div>
    </div>
</section>

<section class="steps-section" id="steps">
    <div class="container">
        @php
        if (!$login) {
            Alert::toast( 'Akun Belum Diverifikasi. Tunggu akun anda diverifikasi oleh admin', 'info');
        }elseif (!$profil) {
            Alert::toast('Silakan lengkapi profil anda', 'info');
        }elseif (!$pengajuan) {
            Alert::toast('Anda bisa mengajukan magang. Anda bisa klik menu pengajuan magang', 'info');
        }elseif ($pengajuanDiproses && (!$pengajuanDiterima && !$magang && !$magangSelesai) ) {
            Alert::toast('Pengajuan magang anda telah di proses. Silakan tunggu konfirmasi dari admin', 'info');
        }elseif (!$pengajuanDiterima && (!$pengajuanDiproses && !$magang && !$magangSelesai) ) {
            Alert::toast('Pengajuan magang anda telah di proses oleh admin. Silakan tunggu konfirmasi dari admin bidang', 'info');
        }elseif ($pengajuan && $pengajuan->kesbangpol == null) {
            Alert::toast('Selamat anda telah di proses di bidang ' . $pengajuan->databidang->nama .'. Silakan upload Surat Kesbangpol di menu pengajuan', 'info');
        }elseif (!$magang && !$magangSelesai) {
            Alert::toast('Anda sudah menyelesaikan syarat syarat magang. Silakan tunggu admin untuk konfirmasi magang anda', 'info');
        }elseif ($magang && !$magangSelesai) {
            Alert::toast('Anda dalam proses magang. Jangan lupa untuk mengisi logbook harian', 'info');
        }elseif ($magangSelesai) {
            Alert::success('Selamat, Anda telah menyelesaikan magang.',' Terima kasih telah berpartisipasi. Silakan isi Survey Kepuasan');
        }
        @endphp
                <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <h2>STATUS PENGAJUAN MAGANG</h2>
                    <div class="step-box">
                        <div class="step" id="step1" @if($login) style="background-color: #03346E;" @endif>
                            <div class="step-number" @if($login) style="color: white;" @endif>1</div>
                            <div class="step-content">
                                <h3 @if($login) style="color: white;" @endif>REGISTRASI DAN LOGIN</h3>
                            </div>
                        </div>
                        <div class="step" id="step2" @if($profil) style="background-color: #03346E;" @endif>
                            <div class="step-number" @if($profil) style="color: white;" @endif>2</div>
                            <div class="step-content">
                                <h3 @if($profil) style="color: white;" @endif>PROFIL MAHASISWA</h3>
                            </div>
                        </div>
                        <div class="step" id="step3" @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="background-color: #03346E;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>3</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiproses || $pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>PENGAJUAN MAGANG</h3>
                            </div>
                        </div>
                        <div class="step" id="step4" @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="background-color: #03346E;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>4</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiteruskan || $pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @elseif($resetPengajuan) style="color: #03346E;" @endif>ACC ADMIN 1</h3>
                            </div>
                        </div>
                        <div class="step" id="step5" @if($pengajuanDiterima || $magang || $magangSelesai) style="background-color: #03346E;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>5</div>
                            <div class="step-content">
                                <h3 @if($pengajuanDiterima || $magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @elseif($resetPengajuan) style="color: #03346E;" @endif>ACC BIDANG</h3>
                            </div>
                        </div>
                        <div class="step" id="step6" @if($magang || $magangSelesai) style="background-color: #03346E;" @elseif($resetPengajuan) style="background-color: #ffffff;" @endif>
                            <div class="step-number" @if($magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>6</div>
                            <div class="step-content">
                                <h3 @if($magang || $magangSelesai) style="color: white;" @elseif($resetPengajuan) style="color: #03346E;" @endif>ACC ADMIN 2</h3>
                            </div>
                        </div>
                        <div class="step" id="step7" @if($magang || $magangSelesai) style="background-color: #03346E;" @endif>
                            <div class="step-number" @if($magang || $magangSelesai) style="color: white;" @endif>7</div>
                            <div class="step-content">
                                <h3 @if($magang || $magangSelesai) style="color: white;" @endif>KEGIATAN MAGANG</h3>
                            </div>
                        </div>
                        <div class="step" id="step8" @if($magangSelesai) style="background-color: #03346E;" @endif>
                            <div class="step-number" @if($magangSelesai) style="color: white;" @endif>8</div>
                            <div class="step-content">
                                <h3 @if($magangSelesai) style="color: white;" @endif>MAGANG SELESAI</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <section style="background-color: #eee;">
                        <div class="container py-4">

                            <div class="row">

                                <div class="col-lg-4">

                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            @if(!$user->foto)
                                            <img src="https://i.pinimg.com/236x/83/52/64/835264761a076845234005154f1bacd8.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                            @else
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="foto profil" class="rounded-circle img-fluid" style="width: 175px; height: 175px;">
                                            @endif
                                            <h5 class="my-3">
                                                @if(!$user->nama)
                                                Nama
                                                @else
                                                {{ $user->nama }}
                                                @endif
                                            </h5>
                                            <p class="text-muted mb-1">{{ $user->nim }}</p>
                                            <p class="text-muted mb-4">
                                                @if(!$user->kampus)
                                                Asal Kampus
                                                @else
                                                {{ $user->kampus }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card mb-6">

                                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                                        <button class="btn" style="width: 100%; background-color: #03346E; color: white;" data-bs-toggle="modal" data-bs-target="#modalform">Lengkapi Profil</button>
                                        @else
                                        <button class="btn" style="width: 100%; background-color: #03346E; color: white;" data-bs-toggle="modal" data-bs-target="#modalformedit">Edit Profil</button>
                                        @endif
                                    </div>

                                    <!-- Modal Untuk Menambah Profil Mahasiswa -->
                                    <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lengkapi Profil Anda</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('mahasiswa.submit', ['id' => $user->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img src="https://i.pinimg.com/236x/83/52/64/835264761a076845234005154f1bacd8.jpg" class="rounded-circle" alt="example placeholder" style="width: 200px;" id="add" />
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <div class="btn btn-rounded" style="background-color: #03346E; color: white;">
                                                                    <label class="form-label text-white m-1" for="customFile2">Pilih Foto Profil</label>

                                                                    <input type="file" class="form-control d-none form-control-user @error('foto') is-invalid @enderror" id="customFile2" name="foto" value="{{ old('foto') }}" onchange="preview(event)">

                                                                    @error('foto')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="col-form-label">Nama Lengkap:</label>
                                                            <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">

                                                            @error('nama')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kampus" class="col-form-label">Asal Kampus:</label>
                                                            <input type="text" class="form-control form-control-user @error('kampus') is-invalid @enderror" id="kampus" name="kampus" value="{{ old('kampus') }}">

                                                            @error('kampus')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jurusan" class="col-form-label">Jurusan:</label>
                                                            <div class="select-group">
                                                                <select name="jurusan_id" id="jurusan_id" class="form-control form-control-user @error('jurusan_id') is-invalid @enderror">
                                                                    <option value="" disabled selected hidden></option>
                                                                    @foreach ($jurusan as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama_jurusan }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('jurusan_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="prodi" class="col-form-label">Prodi:</label>
                                                            <div class="select-group">
                                                                <select name="prodi_id" id="prodi_id" class="form-control form-control-user @error('prodi_id') is-invalid @enderror">
                                                                    <option value="" disabled selected hidden></option>
                                                                    @foreach ($prodi as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama_prodi }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('prodi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">Nomor Telepon:</label>
                                                            <input type="text" class="form-control form-control-user @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}">

                                                            @error('telepon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn" style="background-color: #03346E; color: white;">Kirim Data</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Untuk Edit Profil -->
                                    <div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil Anda</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="POST" action="/mahasiswaupdate/{{ $user->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')

                                                        <div>
                                                            <div class="d-flex justify-content-center mb-4">
                                                                <img src="#" class="rounded-circle" alt="Photo Preview" style="display: none; width: 200px; height: 200px;" id="photo-preview" />
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" name="foto" id="foto" style="display: none;">

                                                                @error('foto')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror

                                                                <label class="form-label text-white m-1" for="foto" style="background-color: #03346E; color: white; padding: 6px 12px; cursor: pointer; border: none;">
                                                                    Ubah Foto Profil
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="col-form-label">Nama Lengkap:</label>
                                                            <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}">

                                                            @error('nama')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">NIM:</label>
                                                            <input type="text" class="form-control form-control-user @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $user->nim) }}">

                                                            @error('nim')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kampus" class="col-form-label">Asal Kampus:</label>
                                                            <input type="text" class="form-control form-control-user @error('kampus') is-invalid @enderror" id="kampus" name="kampus" value="{{ old('kampus', $user->kampus) }}">

                                                            @error('kampus')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jurusan" class="col-form-label">Jurusan:</label>
                                                            <div class="select-group">
                                                                <select name="jurusan_id" id="jurusan_id" class="form-control form-control-user @error('jurusan_id') is-invalid @enderror">
                                                                    <option value="" disabled selected hidden></option>
                                                                    @foreach ($jurusan as $item)
                                                                    <option value="{{ $item->id }}" {{ (old('jurusan_id') ?? $user->jurusan_id) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->nama_jurusan }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('jurusan_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="prodi" class="col-form-label">Prodi:</label>
                                                            <div class="select-group">
                                                                <select name="prodi_id" id="prodi_id" class="form-control form-control-user @error('prodi_id') is-invalid @enderror">
                                                                    <option value="" disabled selected hidden></option>
                                                                    @foreach ($prodi as $item)
                                                                    <option value="{{ $item->id }}" {{ (old('prodi_id') ?? $user->prodi_id) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->nama_prodi }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('prodi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="telepon" class="col-form-label">Nomor Telepon:</label>
                                                            <input type="text" class="form-control form-control-user @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}">

                                                            @error('telepon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn" style="background-color: #03346E; color: white;">Kirim Data</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Menampilkan Data Mahasiswa -->
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @if(!$user->nama)
                                                    <p class="text-muted mb-0">Data belum ditambahkan</p>
                                                    @else
                                                    <p class="text-muted mb-0">{{ $user->nama }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Asal Kampus</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->kampus)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->kampus }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">NIM</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $user->nim }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Jurusan</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if(!$user->jurusan_id)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->jurusan->nama_jurusan }}
                                                        @endif
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
                                                        @if(!$user->prodi_id)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->prodi->nama_prodi}}
                                                        @endif
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
                                                        @if(!$user->telepon)
                                                        Data belum ditambahkan
                                                        @else
                                                        {{ $user->telepon }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center font-weight-bold">LOG AKTIFITAS</h5>
                                            <hr>
                                            @if ($riwayat->isEmpty())
                                            <p class="text-center">Aktivitas Belum Tersedia</p>
                                            @else
                                            <ul class="log-list">
                                                @foreach($riwayat as $r)
                                                <li class="log-item">
                                                    <div class="log-message">{{ $r->pesan }}</div>
                                                    <div class="log-time">{{ $r->created_at->format('d F Y H:i') }}</div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
