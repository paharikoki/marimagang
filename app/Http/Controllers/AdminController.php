<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\DataBidang;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $databidang = DataBidang::all();

        return view('dashboardadmin.admin.index', compact('databidang'));
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:8|max:50',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            Admin::create($validatedData)->assignRole('adminbidang');

            Alert::success('Sukses', 'Data Admin Berhasil Ditambahkan')->showConfirmButton();

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
                'nama' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:60',
                'email' => 'email:dns|unique:admins,email,' . $id,
            ]);

            $admin = Admin::find($id);

            if (!$admin) {
                Alert::error('Error', 'Admin tidak ditemukan')->showConfirmButton();
                return redirect()->back();
            }

            $oldNama = $admin->nama;
            $oldEmail = $admin->email;

            $admin->nama = $request->nama;
            $admin->email = $request->email;
            $admin->save();

            if ($admin->nama !== $oldNama || $admin->email !== $oldEmail) {
                Alert::success('Sukses', 'Data Admin Berhasil Diperbarui')->showConfirmButton();
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
            Admin::destroy($request->id);
            Alert::success('Sukses', 'Data Admin Berhasil Dihapus')->showConfirmButton();
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
