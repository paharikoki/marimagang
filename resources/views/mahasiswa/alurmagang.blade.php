@extends('mahasiswa.layouts.mainupload')

@section('content')
<section class="container">
    <section class="bordered-container">
        <h1 style="text-align: center;">ALUR PENGAJUAN MAGANG</h1>

        <section class="image-container">
            <img class="image" src="{{ asset('assets/images/pengajuan/marimagang.svg') }}" alt="SVG Image">
        </section>
        <hr>

        <section class="description">
            <p>Berdasarkan flowchart diatas terkait bagaimana alur dari permohonan magang hingga kegiatan magang selesai di Kominfo Kabupaten Malang. Dan berikut penjelasan dari flowchart diatas :</p>
        </section>

        <section class="points">
            <div class="point">
                <strong>REGISTER DAN LOGIN :</strong>
                <p>Mahasiswa melakukan register pada menu Login/Register saat pertama kali membuka halaman website dan melakukan verifikasi melalui email untuk dapat login dan melakukan pengajuan magang.</p>
            </div>
            <div class="point">
                <strong>PROFIL MAHASISWA :</strong>
                <p>Sebelum Mahasiswa dapat melakukan pengajuan, langkah awal yang harus dilakukan adalah melengkapi semua profil dengan mengisi data diri pengguna termasuk foto profil (untuk foto profil tidak wajib namun lebih baik dilengkapi).</p>
            </div>
            <div class="point">
                <strong>PENGAJUAN MAGANG :</strong>
                <p>Setelah berhasil melengkapi profil, menu pengajuan magang akan tersedia dan mahasiswa melakukan pengajuan magang dengan sebelumnya mempersiapkan berkas berkas yaitu portofolio yang dikumpulkan dalam bentuk pdf, proposal magang, serta surat pengantar pendidikan dan jika berhasil melakukan pengajuan maka status pada riwayat pengajuan adalah "Diproses".</p>
            </div>
            <div class="point">
                <strong>ACC ADMIN 1 :</strong>
                <p>Pengajuan yang telah dilakukan oleh mahasiswa selanjutnya akan diverifikasi oleh admin. Jika pengajuan yang dilakukan sudah sesuai, maka pengajuan akan diteruskan untuk dapat diverifikasi oleh bidang yang telah dipilih mahasiswa dan status pada riwayat pengajuan berganti menjadi "Diteruskan". jika pengajuan yang dilakukan masih kurang sesuai atau hal lain maka pengajuan akan ditolak dan mahasiswa dapat melihat komentar pada riwayat pengajuan yang tersedia di menu pengajuan magang dan status pengajuan akan berganti menjadi "Ditolak" dan mahasiswa dapat melakukan pengajuan ulang atau tidak di tahap ini tergantung komentar yang diterima.</p>
            </div>
            <div class="point">
                <strong>ACC BIDANG :</strong>
                <p>Setiap bidang juga berperan memverifikasi pengajuan yang dilakukan mahasiswa, jika pengajuan berhasil maka akan masuk pada langkah selanjutnya dan status pengajuan berubah menjadi "Diterima" dan jika pengajuan gagal, pengajuan akan dikembalikan ke admin untuk dapat diverifikasi ulang oleh admin yang bersangkutan dan status pengajuan magang berubah menjadi "Diproses".</p>
            </div>
            <div class="point">
                <strong>ACC ADMIN 2 :</strong>
                <p>Setelah status pengajuan mahasiswa dinyatakan "Diterima". Selanjutnya mahasiswa melakukan pengurusan surat kesbangpol dan jika sudah, dapat langsung mengupload berkas file kesbangpol pada upload kesbangpol di menu pengajuan magang dan menunggu untuk diverifikasi kembali oleh admin.</p>
            </div>
            <div class="point">
                <strong>KEGIATAN MAGANG :</strong>
                <p>Jika berkas file kesbangpol disetujui, selamat anda dinyatakan magang di Kominfo Kabupaten Malang dengan bidang yang dapat dilihat di Riwayat Pengajuan karena admin dapat mengubah bidang anda dengan menyesuaikan portofolio mahasiswa yang sebelumnya di upload dan status pengajuan berubah menjadi "Magang". Jangan lupa menambahkan data anggota pada riwayat pengajuan dan mengisi logbook di setiap harinya selama magang sebagai laporan kegiatan anda selama magang.</p>
            </div>
            <div class="point">
                <strong>MAGANG SELESAI :</strong>
                <p>Setelah dirasa magang telah selesai, mahasiswa dapat upload berkas terakhir yaitu dokumentasi (foto kegiatan), template nilai yang disediakan oleh masing masing tempat pendidikan, dan juga laporan akhir. Jika sudah, silahkan menunggu konfirmasi admin dan jika berhasil, status magang anda akan berubah menjadi "Selesai"</p>
            </div>
        </section>
    </section>
</section>

<section class="contact-us" id="contact">
    <div class="footer">
        <p>Copyright © 2023 <br> Dinas Komunikasi dan Informatika Kabupaten Malang</p>
    </div>
</section>
@endsection