<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardBidangController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataBidangController;
use App\Http\Controllers\PengajuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Landing Page
Route::get('/', [HomeController::class, 'home'])->name('home');

// Route Forms (Login Register)
Route::get('/forms', [FormsController::class, 'form'])->name('forms');

// Route Post Register
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

// Route Post Login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

// Notifikasi
Route::get('/notif', [NotifikasiController::class, 'notif']);

// Route Logout
Route::get('/logout', [LoginController::class, 'logout']);

// Route Detail (Home)
Route::get('/homedetail/{id}', [HomeController::class, 'detail']);

// Email Verifikasi Mahasiswa
Route::get('/verification/{user}', [MahasiswaController::class, 'verify'])->name('verify');

Route::get('/pengajuan/test/{id}', [DashboardMahasiswaController::class, 'pengajuanTest']);
// Route Mahasiswa
Route::middleware(['auth:web'])->group(function () {
    Route::get('/pengajuan', [DashboardMahasiswaController::class, 'pengajuan']);
    Route::get('/alurmagang/{id}', [DashboardMahasiswaController::class, 'alurmagang']);
    Route::get('/anggota/{id}', [DashboardMahasiswaController::class, 'anggota']);
    Route::get('/logbook/{id}', [DashboardMahasiswaController::class, 'logbook']);
    Route::post('/logbook/store/{id}', [PengajuanController::class, 'logbook'])->name('logbook.store');
    Route::put('/kesbangpol', [PengajuanController::class, 'kesbangpol'])->name('kesbangpol.submit');
    Route::put('/laporan', [PengajuanController::class, 'laporan'])->name('laporan.submit');

    Route::get('/mahasiswa', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/profil/submit/{id}', [MahasiswaController::class, 'store'])->name('mahasiswa.submit');
    Route::put('/mahasiswaupdate/{id}', [MahasiswaController::class, 'update']);

    Route::post('/pengajuan-submite/submite', [PengajuanController::class, 'store'])->name('pengajuan.submit');
    Route::get('/pengajuan/pilihan-skill/{databidang_id}', [DashboardMahasiswaController::class, 'select_skill']);

    Route::post('/tambahanggota', [PengajuanController::class, 'tambahanggota'])->name('tambah.anggota');
    Route::put('/editanggota/{id}', [PengajuanController::class, 'editanggota'])->name('edit.anggota');
    Route::delete('/hapusanggota/{id}', [PengajuanController::class, 'deleteanggota'])->name('delete.anggota');

});

// Route Admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboardadmin/{id}', [DashboardAdminController::class, 'index']);

    Route::get('/admin', [DashboardAdminController::class, 'admin']);
    Route::post('/adminpost', [AdminController::class, 'store'])->name('adminpost');
    Route::put('/adminupdate/{id}', [AdminController::class, 'update']);
    Route::get('/admindelete/{id}', [AdminController::class, 'delete']);

    Route::get('/jurusan', [DashboardAdminController::class, 'jurusan']);
    Route::post('/jurusanpost', [JurusanController::class, 'store'])->name('jurusanpost');
    Route::put('/jurusanupdate/{id}', [JurusanController::class, 'update']);
    Route::get('/jurusandelete/{id}', [JurusanController::class, 'delete']);

    Route::get('/prodi', [DashboardAdminController::class, 'prodi']);
    Route::post('/prodipost', [ProdiController::class, 'store'])->name('prodipost');
    Route::put('/prodiupdate/{id}', [ProdiController::class, 'update']);
    Route::get('/prodidelete/{id}', [ProdiController::class, 'delete']);

    Route::get('/block/{id}', [MahasiswaController::class, 'block'])->name('mahasiswa.block');
    Route::get('/verify/{id}', [MahasiswaController::class, 'verifyAdmin'])->name('mahasiswa.verify');

    Route::get('/user', [DashboardAdminController::class, 'user']);
    Route::get('/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail');

    // Route Pengajuan
    Route::get('/pengajuan/update-skill/{databidang_id}', [DashboardAdminController::class, 'select_skill']);

    Route::post('/pengajuan/pdf/{id}', [DashboardAdminController::class, 'pengajuanPdf'])->name('pengajuan.pdf');

    // Route Dashboard Admin
    Route::get('/pengajuanadmin', [DashboardAdminController::class, 'pengajuan']);
    Route::get('/pengajuanditeruskan', [DashboardAdminController::class, 'diteruskan']);
    Route::get('/pengajuanaccadmin', [DashboardAdminController::class, 'konfirmasi']);
    Route::get('/magang', [DashboardAdminController::class, 'magang']);
    Route::put('/diteruskan/{id}', [PengajuanController::class, 'updatebidang']);
    Route::put('/ditolakadmin/{id}', [PengajuanController::class, 'ditolakadmin']);
    Route::get('/userdetailadmin/{id}', [DashboardAdminController::class, 'userdetail']);
    Route::put('/diterimaadmin/{id}', [PengajuanController::class, 'diterimaadmin']);
    Route::put('/selesai', [PengajuanController::class, 'selesai']);

    Route::get('/pdfadmin', [DashboardAdminController::class, 'pdfadmin'])->name('pdfadmin');

    // Route Kirim Email
    Route::post('/kirim-email', [PengajuanController::class, 'email']);

    Route::get('/pengajuanbidangsuper', [DashboardAdminController::class, 'pengajuansuperbidang']);
    Route::get('/pengajuanbidang/{id}', [DashboardAdminController::class, 'pengajuanbidang']);
    Route::get('/userdetailbidang/{id}', [DashboardAdminController::class, 'userdetail']);
    Route::put('/ditolakbidang/{id}', [PengajuanController::class, 'ditolakbidang']);
    Route::put('/diterimabidang/{id}', [PengajuanController::class, 'diterimabidang']);

    Route::get('/pdfbidang/{id}', [DashboardAdminController::class, 'pdfbidang'])->name('pdfbidang');
    Route::get('/magangbidang/{id}', [DashboardAdminController::class, 'magangbidang']);

    Route::get('/dashboardbidang/{id}', [DashboardAdminController::class, 'index'])->name('dashboard.bidang');

    // Route Data Bidang
    Route::get('/databidang/{id}', [DashboardAdminController::class, 'databidang']);
    Route::post('/databidang/submit', [DataBidangController::class, 'store'])->name('databidang.submit');
    Route::get('/databidangdelete/{id}', [DataBidangController::class, 'delete'])->name('databidangdelete');
    Route::get('/open/{id}', [DataBidangController::class, 'open']);
    Route::get('/close/{id}', [DataBidangController::class, 'close'])->name('bidang.close');
    Route::get('/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail');
});
