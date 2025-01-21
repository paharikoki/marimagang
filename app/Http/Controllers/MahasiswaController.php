<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Riwayat;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;


class MahasiswaController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'jurusan_id' => 'required|exists:jurusan,id',
                'prodi_id' => 'required|exists:prodi,id',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ], [
                'nama.required' => 'Nama field is required',
                'nama.regex' => 'Nama field must contain only letters, numbers, and spaces',
                'nama.max' => 'Nama field may not be greater than 60 characters',
                'kampus.required' => 'Kampus field is required',
                'kampus.regex' => 'Kampus field must contain only letters, numbers, spaces, hyphens, and underscores',
                'kampus.max' => 'Kampus field may not be greater than 60 characters',
                'jurusan_id.required' => 'Field jurusan is required',
                'jurusan_id.exists' => 'Selected jurusan is invalid',
                'prodi_id.required' => 'Field prodi is required',
                'prodi_id.exists' => 'Selected prodi is invalid',
                'telepon.required' => 'Telepon field is required',
                'telepon.regex' => 'Telepon field must contain only numbers, spaces, hyphens, and plus symbols',
                'telepon.min' => 'Telepon field must be at least 10 characters',
                'telepon.max' => 'Telepon field may not be greater than 13 characters',
                'foto.image' => 'Foto must be an image',
                'foto.mimes' => 'Foto must be a file of type: jpeg, png, jpg, svg',
                'foto.max' => 'Foto may not be greater than 2 MB',
            ]);

            $photoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa');
            }

            $user->nama = $request->input('nama');
            $user->kampus = $request->input('kampus');
            $user->jurusan_id = $request->jurusan_id;
            $user->prodi_id = $request->prodi_id;
            $user->telepon = $request->input('telepon');
            $user->foto = $photoPath;
            $user->save();

            Alert::success('Sukses', 'Data Profil Berhasil Ditambahkan')->showConfirmButton();

            Riwayat::create([
                'user_id' => auth()->id(),
                'pesan' => 'Anda Berhasil Melengkapi profil'
            ]);

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                Alert::error('Error', 'Pengguna tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'kampus' => 'required|regex:/^[a-zA-Z0-9\s\-_]+$/|max:60',
                'jurusan_id' => 'required|exists:jurusan,id',
                'prodi_id' => 'required|exists:prodi,id',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ], [
                'nama.required' => 'Nama field is required',
                'nama.regex' => 'Nama field must contain only letters, numbers, and spaces',
                'nama.max' => 'Nama field may not be greater than 60 characters',
                'kampus.required' => 'Kampus field is required',
                'kampus.regex' => 'Kampus field must contain only letters, numbers, spaces, hyphens, and underscores',
                'kampus.max' => 'Kampus field may not be greater than 60 characters',
                'jurusan_id.required' => 'Field jurusan is required',
                'jurusan_id.exists' => 'Selected jurusan is invalid',
                'prodi_id.required' => 'Field prodi is required',
                'prodi_id.exists' => 'Selected prodi is invalid',
                'telepon.required' => 'Telepon field is required',
                'telepon.regex' => 'Telepon field must contain only numbers, spaces, hyphens, and plus symbols',
                'telepon.min' => 'Telepon field must be at least 10 characters',
                'telepon.max' => 'Telepon field may not be greater than 13 characters',
                'foto.image' => 'Foto must be an image',
                'foto.mimes' => 'Foto must be a file of type: jpeg, png, jpg, svg',
                'foto.max' => 'Foto may not be greater than 2 MB',
            ]);

            if (
                $user->nama == $request->input('nama') &&
                $user->kampus == $request->input('kampus') &&
                $user->jurusan_id == $request->jurusan_id &&
                $user->prodi_id == $request->prodi_id &&
                $user->telepon == $request->input('telepon') &&
                !$request->hasFile('foto')
            ) {
                Alert::info('', 'Profil Tidak Diperbarui')->showConfirmButton();
                return redirect()->back();
            }

            $user->nama = $request->input('nama');
            $user->kampus = $request->input('kampus');
            $user->jurusan_id = $request->jurusan_id;
            $user->prodi_id = $request->prodi_id;
            $user->telepon = $request->input('telepon');

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    Storage::delete($user->foto);
                }

                $foto = $request->file('foto');
                $photoPath = $foto->store('mahasiswa');
                $user->foto = $photoPath;
            }

            $user->save();

            Alert::warning('Sukses', 'Data Profil Berhasil Diperbarui')->showConfirmButton();

            Riwayat::create([
                'user_id' => auth()->id(),
                'pesan' => 'Anda Berhasil Memperbarui profil'
            ]);

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function verify(User $user)
    {
        if ($user && !$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->verify = '1';
            $user->save();

            $email = $user->email;
            $message = "Kami Menginformasikan Bahwa Status Akun Anda Adalah TERVERIFIKASI. Silahkan Login dan Segera Lakukan Pengajuan Magang Anda.";

            Mail::to($email)->send(new SendEmail($message));

            return redirect()->route('home')->with('success', 'Akun Anda berhasil diverifikasi!');
        }

        return redirect()->route('home')->with('error', 'Akun Anda sudah diverifikasi sebelumnya atau tidak valid.');
    }


    public function block($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->verify = '0';
            $user->save();
            toast('Akun Mahasiswa Tidak Terverifikasi', 'error');
        }

        return redirect()->back();
    }

    public function verifyAdmin($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->verify = '1';
            $user->save();
            toast('Akun Mahasiswa Terverifikasi', 'success');
        }

        return redirect()->back();
    }
}
