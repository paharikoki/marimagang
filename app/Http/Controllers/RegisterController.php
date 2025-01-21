<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimVerifikasi;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nim' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:50',
                'password_confirmation' => 'required|same:password',
            ], [
                'nim.required' => 'Kolom NIM wajib diisi',
                'nim.unique' => 'NIM sudah terdaftar',
                'email.required' => 'Kolom email wajib diisi',
                'email.email' => 'Masukkan alamat email yang valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Kolom kata sandi wajib diisi',
                'password.min' => 'Kata sandi harus terdiri dari minimal 8 karakter',
                'password.max' => 'Kata sandi tidak boleh lebih dari 50 karakter',
                'password_confirmation.required' => 'Kolom konfirmasi kata sandi wajib diisi',
                'password_confirmation.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            Mail::to($user->email)->send(new KirimVerifikasi($user));
            Alert::success('Berhasil', 'Anda Berhasil Registrasi');

            return redirect('/forms#login')->with('success', 'Anda Berhasil Registrasi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/forms#register')->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Registrasi Gagal');
            return redirect('/forms#register')->withInput();
        }
    }
}
