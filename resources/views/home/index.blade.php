@extends('home.layouts.main')

@section('content')
<section class="section main-banner" id="top" data-section="section1">
    <img src="assets/images/diskominfo.png" alt="">

    <div class="video-overlay header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <h6>Hallo Peserta Magang</h6>
                        <h2>Selamat Datang di Mari Magang</h2>
                        <p>Tempat mahasiswa melakukan pendaftaran magang atau PKL di Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                        <div class="main-button-red">
                            <a href="/forms">Gabung Sekarang !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-service-item owl-carousel">
                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/checklist.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>REGISTER DAN LOGIN</h4>
                            <p>Mahasiswa melakukan register pada menu Login/Register saat pertama kali membuka halaman website dan melakukan verifikasi melalui email untuk dapat login dan melakukan pengajuan magang.</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/profil.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>PROFIL MAHASISWA</h4>
                            <p>Sebelum Mahasiswa dapat melakukan pengajuan, langkah awal yang harus dilakukan adalah melengkapi semua profil dengan mengisi data diri pengguna termasuk foto profil (untuk foto profil tidak wajib namun lebih baik dilengkapi).</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/registration.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>PENGAJUAN MAGANG</h4>
                            <p>Mahasiswa melakukan pengajuan magang dengan sebelumnya mempersiapkan berkas-berkas yang diperlukan dalam bentuk pdf dan jika berhasil melakukan pengajuan maka status pada riwayat pengajuan adalah "Diproses".</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/verified-file.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>ACC ADMIN 1 </h4>
                            <p>Jika pengajuan yang dilakukan sudah sesuai, maka pengajuan akan diteruskan untuk dapat diverifikasi oleh bidang yang telah dipilih mahasiswa dan status pada riwayat pengajuan berganti menjadi "Diteruskan" atau "Ditolak"</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/verified-file.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>ACC BIDANG</h4>
                            <p>Setiap bidang juga berperan memverifikasi pengajuan yang dilakukan mahasiswa, jika pengajuan berhasil maka akan masuk pada langkah selanjutnya dan status pengajuan berubah menjadi "Diterima</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/verified-file.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>ACC ADMIN 2</h4>
                            <p>Setelah status pengajuan mahasiswa dinyatakan "Diterima". Selanjutnya mahasiswa melakukan pengurusan surat kesbangpol dan jika sudah, dapat langsung mengupload berkas file kesbangpol</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/telecommuting.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>KEGIATAN MAGANG </h4>
                            <p>Jika berkas file kesbangpol disetujui,dan dinyatakan magang di Kominfo Kabupaten Malang dan status pengajuan berubah menjadi "Magang"</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <img src="assets/images/verified.gif" alt="Animated Icon">
                        </div>
                        <div class="down-content">
                            <h4>MAGANG SELESAI</h4>
                            <p>Setelah dirasa magang telah selesai, mahasiswa dapat upload berkas terakhir yaitu dokumentasi (foto kegiatan), template nilai yang disediakan oleh masing masing tempat pendidikan, dan juga laporan akhir.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Bidang Kerja Dinas Komunikasi dan Informatika Kabupaten Malang</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($databidang as $d)
            <div class="col-lg-4">
                <div class="meeting-item">
                    <div class="thumb">
                        <a href="/homedetail/{{ $d->id }}"><img src="{{ asset('storage/' . $d->thumbnail) }}" alt="New Lecturer Meeting" style="width: 100%; height: 400px;"></a>
                    </div>
                    <div class="down-content">
                        <a href="/homedetail/{{ $d->id }}">
                            <h4 style="margin: 0; padding: 0;">{{ $d->nama }}</h4>
                        </a>
                        <p style="margin: 0; padding: 0;">{{ $d->deskripsi }}</p>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 3 == 0)
        </div>
        <div class="row justify-content-center">
            @endif
            @endforeach
        </div>
    </div>
</section>

<section class="apply-now" id="apply">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="row">
                    <div class="col-lg-12 rounded">
                        <div class="item accordions">
                            <h3>Tanya Jawab Seputar Magang</h3>
                            <p>Pertanyaan umum yang sering ditanyakan oleh para mahasiswa yang ingin mendaftar di Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                            <div class="main-button-red">
                                <div><a href="https://www.instagram.com/kominfokabmlg/">Gabung Sekarang!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordions is-first-expanded">
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apa saja persyaratan yang diperlukan untuk magang ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Syarat yang diperlukan untuk magang adalah menyiapkan surat pengantar magang dari kampus dan proposal magang yang ditujukan ke Dinas Komunikasi dan Informatika Kabupaten Malang</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apakah magang ini berbayar atau tidak ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Seluruh proses pendaftaran dan selama magang tidak akan dikenakan biaya.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Apakah akan ada mentor yang membimbing saat magang berlangsung ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Ya, akan ada mentor yang mengarahkan dan membimbing mahasiswa selama magang berlangsung.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion last-accordion">
                        <div class="accordion-head">
                            <span>Apa proyek yang nanti dikerjakan mahasiswa ketika magang ?</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Untuk proyek yang akan dikerjakan bergantung pada bidang yang diambil oleh mahasiswa</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-facts" id="data">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Data Peserta Mari Magang</h2>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="count-area-content">
                                    <div class="count-digit">{{ $jumlahpengajuan }}</div>
                                    <div class="count-title">Jumlah Seluruh Pengajuan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-12">
                            <div class="count-area-content">
                                <div class="count-digit">{{ $jumlahmagang }}</div>
                                <div class="count-title">Jumlah Peserta Magang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="our-courses" id="courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Dokumentasi Kegiatan Magang</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="owl-courses-item owl-carousel">
                    @foreach($pengajuan as $item)
                    <div class="item">
                        <img src="{{ asset('storage/' . $item->dokumentasi) }}" alt="Dokumentasi" style="width: 275px; height: 225px;">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


@endsection