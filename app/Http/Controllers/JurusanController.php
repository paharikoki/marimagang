<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_jurusan' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
            ]);

            Jurusan::create($validatedData);

            Alert::success('Sukses', 'Data Jurusan Berhasil Ditambahkan')->showConfirmButton();

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
            $request->validate([
                'nama_jurusan' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
            ]);

            $jurusan = Jurusan::find($id);

            if (!$jurusan) {
                Alert::error('Error', 'Jurusan tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $oldNama = $jurusan->nama_jurusan;

            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->save();

            if ($jurusan->nama_jurusan !== $oldNama) {
                Alert::success('Sukses', 'Data jurusan Berhasil Diperbarui')->showConfirmButton();
            }

            return redirect()->back();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred: ' . $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            Jurusan::destroy($request->id);
            Alert::success('Sukses', 'Data Jurusan Berhasil Dihapus')->showConfirmButton();
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
