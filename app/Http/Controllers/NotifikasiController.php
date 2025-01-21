<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notif()
    {
        return view('notifikasi.index', [
            'user'=>auth()->user(),
            'title' => 'Notification',
        ]);
    }
}
