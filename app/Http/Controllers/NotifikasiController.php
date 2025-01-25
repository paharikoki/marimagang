<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notif()
    {
        if (auth()->user()->verify == 1) {
            return redirect()->route('mahasiswa');
        }
        return view('notifikasi.index', [
            'user'=>auth()->user(),
            'title' => 'Notification',
        ]);
    }
}
