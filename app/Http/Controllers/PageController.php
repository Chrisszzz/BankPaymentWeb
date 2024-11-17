<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;

class PageController extends Controller
{
    // Menampilkan daftar instansi
    public function daftarinstansi()
    {
        $instansi = Instansi::all();
        return view('instansi.daftarinstansi', compact('instansi'));
    }

    // Menampilkan form tambah data instansi
    public function tambahinstansi()
    {
        return view('instansi.tambahinstansi');
    }

    // Menyimpan data instansi ke database
    public function store(Request $request)
    {
         // Validasi data
         $request->validate([
            'kode_instansi' => 'required|string',
            'nm_instansi' => 'required|string',
            'total_mahasiswa' => 'required|integer',
            'tgl_mulai_kerjasama' => 'required|date',
            'tgl_akhir_kerjasama' => 'required|date',
        ]);

        // Simpan data
        Instansi::create($request->all());

        // Redirect dengan pesan sukses
        return redirect('/instansi')->with('success', 'Data berhasil disimpan.');
    }
    public function editinstansi($id)
    {
        // Cari data berdasarkan ID
        $instansi = Instansi::findOrFail($id);

        return view('instansi.editinstansi', ["key" => "instansi", "instansi" => $instansi]);
    }

    public function edit(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_instansi' => 'required|string',
            'nm_instansi' => 'required|string',
            'total_mahasiswa' => 'required|integer',
            'tgl_mulai_kerjasama' => 'required|date',
            'tgl_akhir_kerjasama' => 'required|date',
        ]);

        // Cari instansi berdasarkan ID
        $instansi = Instansi::findOrFail($request->id);

        // Update data instansi
        $instansi->update([
            'kode_instansi' => $request->kode_instansi,
            'nm_instansi' => $request->nm_instansi,
            'total_mahasiswa' => $request->total_mahasiswa,
            'tgl_mulai_kerjasama' => $request->tgl_mulai_kerjasama,
            'tgl_akhir_kerjasama' => $request->tgl_akhir_kerjasama,
        ]);

        // Redirect dengan pesan sukses
        return redirect('/instansi')->with('success', 'Data berhasil diperbarui.');
    }


    public function delete($id)
    {
        // Cari instansi berdasarkan ID
        $instansi = Instansi::findOrFail($id);

        // Hapus data instansi
        $instansi->delete();

        // Redirect dengan pesan sukses
        return redirect('/instansi')->with('success', 'Data berhasil dihapus.');
    }


}
