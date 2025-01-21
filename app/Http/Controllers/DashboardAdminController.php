<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\SkillUser;
use App\Models\Anggota;
use App\Models\DataBidang;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class DashboardAdminController extends Controller
{
    public function index($id)
    {
        $admin = Admin::findorfail($id);
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();

        return view('dashboardadmin.index', [
            'title' => 'Home',
            'admin' => $admin,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'sekretariat' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%sekretariat%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'aptika' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%aptika%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'statistik' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%statistik%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'infrastruktur' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%infrastruktur%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'komunikasi' => DB::table('pengajuan')
                ->join('databidang', 'pengajuan.databidang_id', '=', 'databidang.id')
                ->where('databidang.nama', 'LIKE', '%komunikasi%')
                ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
                ->count(),

            'diproses' => DB::table('pengajuan')->where('status', 'Diproses')->count(),
            'diteruskan' => DB::table('pengajuan')->where('status', 'Diteruskan')->count(),
            'diterima' => DB::table('pengajuan')->where('status', 'Diterima')->count(),
            'ditolak' => DB::table('pengajuan')->where('status', 'Ditolak')->count(),
            'magang' => DB::table('pengajuan')->where('status', 'Magang')->count(),
            'selesai' => DB::table('pengajuan')->where('status', 'Selesai')->count(),
        ]);
    }

    public function admin()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        $databidang = DataBidang::all();
        return view('dashboardadmin.admin.index', [
            'title' => 'Home',
            'admin' => $admins,
            'databidang' => $databidang,
        ]);
    }

    public function jurusan()
    {
        $jurusans = Jurusan::orderBy('created_at', 'desc')->get();
        return view('dashboardadmin.jurusan.index', [
            'title' => 'Jurusan',
            'jurusan' => $jurusans,
        ]);
    }

    public function prodi()
    {
        $prodi = Prodi::orderBy('created_at', 'desc')->get();
        return view('dashboardadmin.prodi.index', [
            'title' => 'Prodi',
            'prodi' => $prodi,
        ]);
    }

    public function user()
    {
        $user = User::orderBy('verify', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin.mahasiswa.index', [
            'title' => 'User',
            'user' => $user,
        ]);
    }

    public function userdetail($id)
    {
        $pengajuan = Pengajuan::with('user.skilluser', 'user.skilluser.skill.databidang')->findOrFail($id);
        $anggota = Anggota::where('pengajuan_id', $pengajuan->id)->get();
        $admin = Admin::findOrFail($id);
        $tanggallogbook = $pengajuan->tanggallogbook;
        return view('dashboardadmin.pengajuan.detail', [
            'title' => 'Landing Page',
            'pengajuan' => $pengajuan,
            'admin' => $admin,
            'anggota' => $anggota,
            'tanggallogbook' => $tanggallogbook,
            'logbook' => DB::table('logbooks')->get(),
        ]);
    }

    public function pengajuan()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diproses')->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
            'databidang' => DB::table('databidang')->where('status', 'Buka')->get()
        ]);
    }

    public function getSkills($pengajuanId)
    {
        $skills = SkillUser::where('pengajuan_id', $pengajuanId)
            ->with('skill')
            ->get();

        return response()->json($skills);
    }


    public function diteruskan()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.diteruskan', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function pengajuansuperbidang()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan_bidang.index', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function konfirmasi()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Diterima', 'Ditolak'])
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan.konfirmasi', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function magang()
    {
        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
            ->orderBy('pengajuan.status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin.pengajuan.magang', [
            'title' => 'Pengajuan',
            'pengajuan' => $pengajuan,
        ]);
    }

    public function select_skill($databidang_id)
    {
        $skill = DB::table('skill')->select('id', 'nama as text')->where('databidang_id', $databidang_id)->get();
        $data = ['results' => $skill];
        return $data;
    }

    public function pdfadmin()
    {
        $pengajuan = Pengajuan::whereIn('status', ['Magang', 'Selesai'])
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('dashboardadmin.pengajuan.pdf', compact('pengajuan')));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream('pengajuan.pdf');
    }

    public function pdfbidang($id)
    {
        $databidangId = DataBidang::where('bidang_id', $id)->value('id');

        if (!$databidangId) {
            abort(404, 'DataBidang tidak ditemukan');
        }

        $admin = Admin::findOrFail($id);
        $pengajuan = Pengajuan::whereIn('status', ['Magang', 'Selesai'])
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(view('dashboardadmin.pengajuan.pdf', compact('pengajuan')));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream('pengajuan.pdf');
    }

    public function databidang($id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboardadmin.databidang.index', [
            'title' => 'Home',
            'admin' => $admin,
            'databidang' => DB::table('databidang')->where('admin_id', $admin->id)->get()
        ]);
    }

    public function detail($id)
    {
        $admin = Admin::findOrFail($id);
        $databidang = DataBidang::findOrFail($id);

        $skill = $databidang->skill;
        return view('dashboardadmin.databidang.detail', [
            'title' => 'Landing Page',
            'databidang' => $databidang,
            'admin' => $admin,
            'skill' => $skill
        ]);
    }

    public function pengajuanbidang($id)
    {
        $admin = Admin::findOrFail($id);
        $databidangId = DataBidang::where('admin_id', $admin->id)->value('id');

        if (!$databidangId) {
            abort(404, 'DataBidang tidak ditemukan');
        }

        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.status', 'Diteruskan')
            ->where('pengajuan.databidang_id', $databidangId)
            ->orderBy('created_at', 'desc')->get();

        return view('dashboardadmin.pengajuan_bidang.index', [
            'title' => 'Pengajuan',
            'admin' => $admin,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function magangbidang($id)
    {

        $admin = Admin::findOrFail($id);
        $databidangId = DataBidang::where('admin_id', $admin->id)->value('id');

        if (!$databidangId) {
            abort(404, 'DataBidang tidak ditemukan');
        }


        $pengajuan = Pengajuan::with(['user', 'skilluser.skill', 'databidang'])
            ->where('pengajuan.databidang_id', $databidangId)
            ->whereIn('pengajuan.status', ['Magang', 'Selesai'])
            ->orderBy('pengajuan.status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin.pengajuan_bidang.magang', [
            'title' => 'Pengajuan',
            'admin' => $admin,
            'pengajuan' => $pengajuan,
        ]);
    }

    private function formatTanggalKapital($tanggal)
    {
        $date = new \DateTime($tanggal);
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
    }

    public function pengajuanPdf(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string',
            'nama_petugas' => 'required|string',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'judul_kegiatan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $pengajuan = Pengajuan::with(['user.jurusan', 'user.prodi'])->findOrFail($id);

        $anggota = Anggota::where('pengajuan_id', $pengajuan->id)->get();

        $nomorSurat = $request->input('nomor_surat');
        $namaPetugas = $request->input('nama_petugas');
        $NIP = $request->input('nip');
        $jabatan = $request->input('jabatan');
        $judulKegiatan = $request->input('judul_kegiatan');
        $tanggal = $this->formatTanggalKapital($request->input('tanggal'));

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $pdf = new \Dompdf\Dompdf($options);

        $html = view('dashboardadmin.pengajuan.detailpdf', [
            'user' => $pengajuan->user,
            'anggota' => $anggota,
            'kampus' => $pengajuan->user->kampus,
            'nomor_surat' => $nomorSurat,
            'nama_petugas' => $namaPetugas,
            'nip' => $NIP,
            'jabatan' => $jabatan,
            'judul_kegiatan' => $judulKegiatan,
            'tanggal' => $tanggal,
            'tanggalmulai' => $pengajuan->tanggalmulai,
            'tanggalselesai' => $pengajuan->tanggalselesai,
            'jurusan' => $pengajuan->user->jurusan->nama_jurusan ?? 'Tidak ada jurusan',
            'prodi' => $pengajuan->user->prodi->nama_prodi ?? 'Tidak ada prodi',
            'bidang' => $pengajuan->databidang->nama,
        ])->render();

        $pdf->loadHtml($html);

        $pdf->setPaper('Legal', 'portrait');

        $pdf->render();

        return $pdf->stream('pengajuan_detail.pdf');
    }
}
