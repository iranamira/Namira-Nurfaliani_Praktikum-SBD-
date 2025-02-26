<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function create()
    {
        $chronic_diseases = [
            'sakit jantung' => 'Sakit Jantung',
            'asma' => 'Asma',
            'alergi' => 'Alergi',
            'penyakit kronis lainnya' => 'Penyakit Kronis Lainnya',
            'tidak memiliki penyakit kronis' => 'Tidak Memiliki Penyakit Kronis'
        ];
        return view('admin.add', compact('chronic_diseases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'chronic_disease' => 'required'
        ]);

        DB::insert(
            'INSERT INTO admin(id_admin, nama_admin, alamat, username, password, chronic_disease) VALUES (:id_admin, :nama_admin, :alamat, :username, :password, :chronic_disease)',
            [
                'id_admin' => $request->id_admin,
                'nama_admin' => $request->nama_admin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
                'chronic_disease' => $request->chronic_disease
            ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil disimpan');
    }

    public function index()
    {
        $datas = DB::select('select * from admin where deleted_at is null');
        $chronic_diseases = [
            'sakit jantung' => 'Sakit Jantung',
            'asma' => 'Asma',
            'alergi' => 'Alergi',
            'penyakit kronis lainnya' => 'Penyakit Kronis Lainnya',
            'tidak memiliki penyakit kronis' => 'Tidak Memiliki Penyakit Kronis'
        ];
        return view('admin.index', compact('datas', 'chronic_diseases'));
    }

    public function edit($id)
    {
        $data = DB::table('admin')->where('id_admin', $id)->first();
        $chronic_diseases = [
            'sakit jantung' => 'Sakit Jantung',
            'asma' => 'Asma',
            'alergi' => 'Alergi',
            'penyakit kronis lainnya' => 'Penyakit Kronis Lainnya',
            'tidak memiliki penyakit kronis' => 'Tidak Memiliki Penyakit Kronis'
        ];
        return view('admin.edit', compact('data', 'chronic_diseases'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'chronic_disease' => 'required'
        ]);

        DB::update(
            'UPDATE admin SET id_admin = :id_admin, nama_admin = :nama_admin, alamat = :alamat, username = :username, password = :password, chronic_disease = :chronic_disease WHERE id_admin = :id',
            [
                'id' => $id,
                'id_admin' => $request->id_admin,
                'nama_admin' => $request->nama_admin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
                'chronic_disease' => $request->chronic_disease
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil diubah');
    }

    public function delete($id)
    {
        // Ubah delete menjadi soft delete - gunakan datetime('now') untuk SQLite
        DB::update('UPDATE admin SET deleted_at = datetime("now") WHERE id_admin = :id_admin', ['id_admin' => $id]);
        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil dipindahkan ke trash');
    }

    // Metode untuk fitur trash
    
    public function trash()
    {
        $datas = DB::select('SELECT * FROM admin WHERE deleted_at IS NOT NULL');
        return view('admin.trash', compact('datas'));
    }
    
    public function restore($id)
    {
        DB::update('UPDATE admin SET deleted_at = NULL WHERE id_admin = :id_admin', ['id_admin' => $id]);
        return redirect()->route('admin.trash')->with('success', 'Data Admin berhasil dipulihkan');
    }
    
    public function restoreAll()
    {
        DB::update('UPDATE admin SET deleted_at = NULL WHERE deleted_at IS NOT NULL');
        return redirect()->route('admin.trash')->with('success', 'Semua data Admin berhasil dipulihkan');
    }
    
    public function forceDelete($id)
    {
        DB::delete('DELETE FROM admin WHERE id_admin = :id_admin', ['id_admin' => $id]);
        return redirect()->route('admin.trash')->with('success', 'Data Admin berhasil dihapus permanen');
    }
}