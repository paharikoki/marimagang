<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;

class ProdiController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_prodi' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
            ]);

            Prodi::create($validatedData);

            Alert::success('Sukses', 'Data Prodi Berhasil Ditambahkan')->showConfirmButton();

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
            $prodi = Prodi::find($id);

            $request->validate([
                'nama_prodi' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
            ]);


            if (!$prodi) {
                Alert::error('Error', 'Prodi tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $oldNama = $prodi->nama_prodi;

            $prodi->nama_prodi = $request->nama_prodi;
            $prodi->save();

            if ($prodi->nama !== $oldNama) {
                Alert::success('Sukses', 'Data Prodi Berhasil Diperbarui')->showConfirmButton();
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
            Prodi::destroy($request->id);
            Alert::success('Sukses', 'Data Prodi Berhasil Dihapus')->showConfirmButton();
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
