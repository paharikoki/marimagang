<?php

namespace App\Http\Controllers;

use App\Models\SkillUser;
use App\Models\Pengajuan;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Logbook;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Request Data :', $request->all());
        if ($request->hasFile('bukti')) {
            Log::info('File found:', $request->file('bukti')->getClientOriginalName());
        }else{
            Log::info('No file uploaded');
        }
        dd($request->all());
        try {
            $request->validate([
                'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'end_date' => 'required|date|after:start_date',
                'databidang_id' => 'required|exists:databidang,id',
                'skill' => 'required|array',
                'bukti' => 'required|mimes:pdf|max:2048',
                'deskripsi',
                'pengantar' => 'required|mimes:pdf|max:2048',
                'proposal' => 'required|mimes:pdf|max:2048',
                'cv' => 'nullable|mimes:pdf|max:800',
            ], [
                'start_date.required' => 'Tanggal Mulai is required',
                'start_date.date' => 'Invalid Tanggal Mulai format',
                'start_date.after_or_equal' => 'Tanggal Mulai must be after or equal to today',
                'end_date.required' => 'Tanggal Selesai is required',
                'end_date.date' => 'Invalid Tanggal Selesai format',
                'end_date.after' => 'Tanggal Selesai must be after the start date',
                'databidang_id.required' => 'Field Bidang is required',
                'databidang_id.exists' => 'Selected Bidang is invalid',
                'skill.required' => 'Skill is required',
                'skill.array' => 'Skill must be an array',
                'bukti.required' => 'Bukti is required',
                'bukti.mimes' => 'Bukti must be in PDF format',
                'bukti.max' => 'Bukti may not be greater than 2 MB',
                'pengantar.required' => 'Surat Pengantar is required',
                'pengantar.mimes' => 'Surat Pengantar must be in PDF format',
                'pengantar.max' => 'Surat Pengantar may not be greater than 2 MB',
                'proposal.required' => 'Proposal is required',
                'proposal.mimes' => 'Proposal must be in PDF format',
                'proposal.max' => 'Proposal may not be greater than 2 MB',
                'cv.mimes' => 'cv must be in PDF format',
                'cv.max' => 'cv may not be greater than 800 KB',
            ]);

            $user_id = $request->input('user_id');

            $skills = $request->input('skill');

            if (!empty($skills)) {
                $pengajuan = Pengajuan::create([
                    'user_id' => auth()->id(),
                    'databidang_id' => $request->databidang_id,
                    'tanggalmulai' => $request->input('start_date'),
                    'tanggalselesai' => $request->input('end_date'),
                    'deskripsi' => $request->input('deskripsi'),
                    'status' => 'Diproses',
                    'bukti' => $request->file('bukti')->store('bukti', 'public'),
                    'pengantar' => $request->file('pengantar')->store('pengantar', 'public'),
                    'proposal' => $request->file('proposal')->store('proposal', 'public'),
                    'cv' => $request->file('cv')->store('cv', 'public'),
                ]);

                session(['pengajuan_id' => $pengajuan->id]);

                foreach ($skills as $skill) {
                    SkillUser::create([
                        'user_id' => $user_id,
                        'skill_id' => $skill,
                        'pengajuan_id' => $pengajuan->id
                    ]);
                }
            }

            Alert::success('Sukses', 'Data Pengajuan Berhasil Dikirim')->showConfirmButton();

            Riwayat::create([
                'user_id' => auth()->id(),
                'pesan' => 'Anda Berhasil Melakukan Pengajuan Magang dan Jangan Lupa Tambahkan Data Anggota (Jika Ada)'
            ]);

            return redirect()->route('mahasiswa', ['id' => $request->user()->id]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function updatebidang(Request $request, $id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->databidang_id = $request->input('databidang');

            if ($request->has('skill')) {
                $request->validate([
                    'skill' => 'array',
                ]);

                $pengajuan->skilluser()->delete();

                $skills = $request->input('skill', []);
                foreach ($skills as $skill) {
                    SkillUser::create([
                        'user_id' => $pengajuan->user_id,
                        'skill_id' => $skill,
                        'pengajuan_id' => $pengajuan->id
                    ]);
                }
            }

            $pengajuan->status = 'Diteruskan';
            $pengajuan->save();

            Alert::success('Sukses', 'Data Skill Pengajuan Berhasil Dikirim')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Status Pengajuan Anda Sedang Diteruskan Ke Bidang, Silahkan Cek Riwayat Pengajuan'
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

    public function ditolakadmin(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Ditolak',
                'komentar' => $request->input('komentar'),
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Ditolak')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Pengajuan Magang Anda Ditolak Oleh Admin, Cek Komentar Pada Riwayat Pengajuan'
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

    public function ditolakbidang(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Diproses',
                'komentar' => $request->input('komentar'),
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Ditolak')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Pengajuan Magang Anda Ditolak Oleh Bidang, Tunggu Verifikasi Admin'
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

    public function diterimabidang(Request $request, $id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            $pengajuan->update([
                'status' => 'Diterima',
            ]);

            Alert::success('Sukses', 'Pengajuan Magang Diterima')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Pengajuan Magang Anda Berhasil Diterima, Silahkan Upload File Kesbangpol'
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

    public function diterimaadmin(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
                'kesediaan' => 'required|mimes:pdf|max:2048'
            ]);

            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->suratmagang) {
                Storage::disk('public')->delete($pengajuan->suratmagang);
            }

            $kesediaan = $request->file('kesediaan')->store('kesediaan', 'public');

            $pengajuan->update([
                'status' => 'Magang',
                'komentar' => $request->input('komentar'),
                'kesediaan' => $kesediaan
            ]);

            $pesan = 'Pengajuan Anda Berhasil dan Anda Dinyatakan Magang, Jangan Lupa Mengisi Logbook Serta Upload Laporan Magang';
            $pesanArray = explode(', ', $pesan);

            foreach ($pesanArray as $key => $message) {
                if ($key == 0) {
                    Riwayat::create([
                        'user_id' => $request->input('user_id'),
                        'pesan' => $message
                    ]);
                } else {
                    Riwayat::create([
                        'user_id' => $request->input('user_id'),
                        'pesan' => $message
                    ]);
                }
            }

            Alert::success('Sukses', 'Data Pengajuan Berhasil Diterima')->showConfirmButton();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    public function kesbangpol(Request $request)
    {
        try {
            $request->validate([
                'kesbangpol' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
            ], [
                'kesbangpol.required' => 'Kesbangpol file is required.',
                'kesbangpol.mimes' => 'Kesbangpol file must be a PDF.',
                'kesbangpol.max' => 'Kesbangpol file may not be greater than 2048 kilobytes in size.',
                'id.required' => 'ID field is required.',
                'id.exists' => 'Selected ID is invalid.',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->kesbangpol) {
                Storage::disk('public')->delete($pengajuan->kesbangpol);
            }

            $kesbangpolFile = $request->file('kesbangpol')->store('kesbangpol', 'public');

            $pengajuan->update(['kesbangpol' => $kesbangpolFile]);

            Alert::success('Success', 'File Kesbangpol Berhasil Terkirim')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Anda Berhasil Mengupload File Kesbangpol'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        return redirect()->route('mahasiswa', ['id' => $request->user()->id]);
    }


    public function laporan(Request $request)
    {
        try {
            $request->validate([
                'laporan' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
                'dokumentasi' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nilai' => 'required|mimes:docx|max:2048',
            ], [
                'laporan.required' => 'Laporan file is required.',
                'laporan.mimes' => 'Laporan file must be a PDF.',
                'laporan.max' => 'Laporan file may not be greater than 2048 kilobytes in size.',
                'id.required' => 'ID field is required.',
                'id.exists' => 'Selected ID is invalid.',
                'dokumentasi.required' => 'Dokumentasi file is required.',
                'dokumentasi.image' => 'Dokumentasi file must be an image.',
                'dokumentasi.mimes' => 'Dokumentasi file must be a JPEG, PNG, or JPG.',
                'dokumentasi.max' => 'Dokumentasi file may not be greater than 2048 kilobytes in size.',
                'nilai.required' => 'Nilai file is required.',
                'nilai.mimes' => 'Nilai file must be a DOCX.',
                'nilai.max' => 'Nilai file may not be greater than 2048 kilobytes in size.',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->laporan) {
                Storage::disk('public')->delete($pengajuan->laporan);
            }

            if ($pengajuan->dokumentasi) {
                Storage::disk('public')->delete($pengajuan->dokumentasi);
            }

            if ($pengajuan->nilai) {
                Storage::disk('public')->delete($pengajuan->nilai);
            }

            $laporan = $request->file('laporan')->store('laporan', 'public');
            $dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $nilai = $request->file('nilai')->store('nilai', 'public');

            $pengajuan->update([
                'laporan' => $laporan,
                'dokumentasi' => $dokumentasi,
                'nilai' => $nilai,
            ]);

            $pesan = 'Anda Telah Mengupload Seluruh Berkas Akhir Magang, Tunggu Verifikasi Admin Untuk Menilai Kinerja Magang Anda';
            $pesanArray = explode(', ', $pesan);

            foreach ($pesanArray as $key => $message) {
                if ($key == 0) {
                    Riwayat::create([
                        'user_id' => $request->input('user_id'),
                        'pesan' => $message
                    ]);
                } else {
                    Riwayat::create([
                        'user_id' => $request->input('user_id'),
                        'pesan' => $message
                    ]);
                }
            }

            Alert::success('Success', 'Data Akhir Berhasil Terkirim')->showConfirmButton();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        return redirect()->route('mahasiswa', ['id' => $request->user()->id]);
    }


    public function tambahanggota(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'nim' => 'required',
            ]);

            $user_id = auth()->user()->id;

            $pengajuan_id = $request->input('id_pengajuan');

            Anggota::create([
                'user_id' => $user_id,
                'pengajuan_id' => $pengajuan_id,
                'nama' => $request->input('nama'),
                'nim' => $request->input('nim'),
            ]);

            Alert::success('Berhasil', 'Anggota berhasil ditambahkan');

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Anda Berhasil Menambahkan Data Anggota Kelompok Magang'
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

    public function editanggota(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'nim' => 'required|unique:anggota,nim,' . $id,
            ]);

            $anggota = Anggota::findOrFail($id);

            $anggota->update([
                'nama' => $request->input('nama'),
                'nim' => $request->input('nim'),
            ]);

            Alert::success('Berhasil', 'Anggota berhasil diupdate');

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Anda Berhasil Memperbarui Data Anggota Kelompok Magang'
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

    public function deleteanggota(Request $request, $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();

            Alert::success('Berhasil', 'Anggota berhasil dihapus');

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Anda Telah Menghapus Data Anggota Kelompok Magang'
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

    public function selesai(Request $request)
    {
        try {
            $request->validate([
                'nilai' => 'required|mimes:docx|max:2048',
                'suratmagang' => 'required|mimes:pdf|max:2048',
                'id' => 'required|exists:pengajuan,id',
            ]);

            $id = $request->input('id');
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->nilai) {
                Storage::disk('public')->delete($pengajuan->nilai);
            }

            $suratmagang = $request->file('suratmagang')->store('suratmagang', 'public');
            $nilai = $request->file('nilai')->store('nilai', 'public');

            $pengajuan->update([
                'nilai' => $nilai,
                'suratmagang' => $suratmagang,
                'status' => 'Selesai'
            ]);

            Alert::success('Sukses', 'Magang Telah Diselesaikan')->showConfirmButton();

            Riwayat::create([
                'user_id' => $request->input('user_id'),
                'pesan' => 'Terima Kasih...Magang Anda Telah Berakhir, Cek Nilai Anda'
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

    public function logbook(Request $request, $id)
    {
        try {
            $request->validate([
                'kegiatan' => ['required', function ($attribute, $value, $fail) {
                    $wordCount = str_word_count($value);
                    if ($wordCount < 20) {
                        $fail('The ' . $attribute . ' must be at least 20 words.');
                    }
                }],
                'tanggal' => 'required|date',
            ]);

            $user = User::findOrFail($id);
            $user_id = $user->id;
            $pengajuan_id = $request->input('id_pengajuan');

            $tanggal = Carbon::parse($request->tanggal);

            Logbook::create([
                'user_id' => $user_id,
                'pengajuan_id' => $pengajuan_id,
                'tanggal' => $tanggal,
                'kegiatan' => $request->kegiatan,
            ]);

            Alert::success('Sukses', 'Logbook Berhasil Ditambahkan')->showConfirmButton();

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function email(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        $email = $data['email'];
        $message = $data['pesan'];

        try {
            Mail::to($email)->send(new SendEmail($message));

            Alert::success('Sukses', 'Email Berhasil Dikirim')->showConfirmButton();
            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }
}
