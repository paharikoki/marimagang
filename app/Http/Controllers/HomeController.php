<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataBidang;
use App\Models\User;
use App\Models\Pengajuan;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.index', [
            'title' => 'Home',
            'databidang' => DB::table('databidang')->get(),
            'jumlahuser' => DB::table('users')->where('verify', 1)->count(),
            'jumlahdatabidang' => DB::table('databidang')->count(),
            'jumlahpengajuan' => DB::table('pengajuan')->count(),
            'jumlahmagang' => DB::table('pengajuan')->whereIn('status', ['Magang', 'Selesai'])->count(),
            'pengajuan' => DB::table('pengajuan')
                ->where('status', 'Selesai')
                ->whereNotNull('dokumentasi')
                ->orderBy('created_at', 'desc')
                ->limit(15)
                ->get()
        ]);
    }

    public function detail($id)
    {
        $databidang = DataBidang::findOrFail($id);
        $skill = $databidang->skill;
        $pengajuan = Pengajuan::where('databidang_id', $id)->where('status', 'Magang')->paginate(10); // Paginate with 10 records per page

        return view('home.detail', [
            'title' => 'Home',
            'databidang' => $databidang,
            'skill' => $skill,
            'pengajuan' => $pengajuan
        ]);
    }
}
