<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\Tagihan;
use App\DetailTagihan;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function home() {
        if (!session()->has('user')) {
            return redirect('/')->withErrors(['login_error' => 'Silakan login terlebih dahulu']);
        }
        return view('home');
    }

    public function daftarinstansi(Request $request)
    {
        $query = Instansi::query();

        // Filter berdasarkan nama instansi
        if ($request->filled('nama_instansi')) {
            $query->where('nm_instansi', 'like', '%' . $request->nama_instansi . '%');
        }

        // Pagination (10 data per halaman)
        $instansi = $query->paginate(10);

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

    public function daftarVA(Request $request)
    {
        // Query dasar untuk Instansi
        $query = Instansi::query();

        // Filter berdasarkan nama instansi
        if ($request->filled('nama_instansi')) {
            $query->where('nm_instansi', 'like', '%' . $request->nama_instansi . '%');
        }

        // Eksekusi query dengan pagination
        $instansi = $query->paginate(10);

        return view('va.daftarva', compact('instansi'));
    }

    public function daftarpembayaran(Request $request)
    {
        $query = Tagihan::query();

        // Filter berdasarkan nama instansi
        if ($request->filled('id_mahasiswa')) {
            $query->where('id_mahasiswa', 'like', '%' . $request->id_mahasiswa . '%');
        }

        // Pagination (10 data per halaman)
        $tagihan = $query->paginate(10);

        return view('pembayaran.daftarpembayaran', compact('tagihan'));
    }

    public function formtambahpembayaran()
    {
        return view('pembayaran.tambahpembayaran');
    }

    public function storepembayaran(Request $request)
    {
        $request->validate([
            'id_instansi' => 'required|integer',
            'id_dtl_tagihan' => 'required|integer',
            'id_mahasiswa' => 'required|string',
            'periode' => 'required|string',
            'sks' => 'required|integer',
            'ice' => 'required|string',
            'potongan_prestasi' => 'required|string',
            'denda' => 'required|string',
            'tgl_jth_tempo' => 'required|date',
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        // Ambil data detail_tagihan
        $detailTagihan = DetailTagihan::where('id_dtl_tagihan', $request->id_dtl_tagihan)->first();

        if (!$detailTagihan) {
            return back()->withErrors(['id_dtl_tagihan' => 'Detail tagihan tidak ditemukan.']);
        }

        // Perhitungan jumlah tagihan
        $biayaSks = $detailTagihan->biaya_sks * $request->sks;
        $biayaIce = $request->ice === 'Mengambil' ? $detailTagihan->biaya_ICE : 0;
        $totalPotongan = $request->potongan_prestasi === 'Iya' ? $detailTagihan->potongan_prestasi : 0;
        $totalDenda = $request->denda === 'Iya' ? $detailTagihan->hrg_denda : 0;

        $jumlahTagihan =
            $biayaSks +
            $biayaIce +
            $detailTagihan->biaya_kesehatan +
            $detailTagihan->biaya_gedung -
            $totalPotongan +
            $totalDenda;

        // Simpan data tagihan ke database
        Tagihan::create([
            'id_instansi' => $request->id_instansi,
            'id_dtl_tagihan' => $request->id_dtl_tagihan,
            'id_mahasiswa' => $request->id_mahasiswa,
            'periode' => $request->periode,
            'sks' => $request->sks,
            'ice' => $request->ice,
            'potongan_prestasi' => $request->potongan_prestasi,
            'denda' => $request->denda,
            'jmlh_tgh' => $jumlahTagihan,
            'tgl_jth_tempo' => $request->tgl_jth_tempo,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/pembayaran')->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function getDetailTagihan(Request $request)
    {
        $request->validate([
            'id_dtl_tagihan' => 'required|integer|exists:detail_tagihan,id',
        ]);

        $detailTagihan = DetailTagihan::find($request->id_dtl_tagihan);

        if ($detailTagihan) {
            return response()->json([
                'success' => true,
                'data' => $detailTagihan
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Detail Tagihan tidak ditemukan.'
        ]);
    }

    public function formeditpembayaran($id)
    {
        $tagihan = Tagihan::where('id_tagihan', $id)->firstOrFail();
        return view('pembayaran.editpembayaran', compact('tagihan'));
    }


    public function editpembayaran(Request $request, $id_tagihan)
    {
        $tagihan = Tagihan::findOrFail($id_tagihan); // Cari tagihan berdasarkan id_tagihan

        // Ambil detail tagihan dengan kolom yang benar
        $detailTagihan = DetailTagihan::where('id_dtl_tagihan', $tagihan->id_dtl_tagihan)->firstOrFail();

        // Lakukan perhitungan untuk jumlah tagihan baru
        $sks = $request->input('sks');
        $ice = $request->input('ice');
        $potonganPrestasi = $request->input('potongan_prestasi');
        $denda = $request->input('denda');

        // Menghitung jumlah tagihan berdasarkan input yang baru
        $biayaSks = $detailTagihan->biaya_sks * $sks;
        $biayaIce = $ice === 'Mengambil' ? $detailTagihan->biaya_ICE : 0;
        $potongan = $potonganPrestasi === 'Iya' ? $detailTagihan->potongan_prestasi : 0;
        $biayaDenda = $denda === 'Iya' ? $detailTagihan->hrg_denda : 0;

        $jumlahTagihan = $biayaSks + $biayaIce + $detailTagihan->biaya_kesehatan + $detailTagihan->biaya_gedung - $potongan + $biayaDenda;

        // Simpan data tagihan yang telah diperbarui
        $tagihan->update([
            'sks' => $sks,
            'ice' => $ice,
            'potongan_prestasi' => $potonganPrestasi,
            'denda' => $denda,
            'jmlh_tgh' => $jumlahTagihan, // Update jumlah tagihan
            // kolom lain yang perlu diperbarui
        ]);

        return redirect('/pembayaran')->with('success', 'Data pembayaran berhasil diperbarui!');
    }

    public function deletepembayaran($id_tagihan)
    {
        // Cari tagihan berdasarkan id_tagihan
        $tagihan = Tagihan::where('id_tagihan', $id_tagihan)->firstOrFail();

        // Hapus data
        $tagihan->delete();

        return redirect('/pembayaran')->with('success', 'Data berhasil dihapus!');
    }

    public function manajemenpembayaran()
    {
        // Fetch the first record of DetailTagihan
        $detailTagihan = DetailTagihan::first();

        // Pass the data to the view
        return view('detailtagihan.manajemenpembayaran', compact('detailTagihan'));
    }



}




