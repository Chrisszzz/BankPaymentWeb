<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tagihan;
use App\DetailTagihan;
use App\Va;


class APIController extends Controller
{
    // public function detailva(Request $request)
    // {
    //     // Ambil data tagihan beserta relasi VA dan Mahasiswa
    //     $tagihan = Tagihan::with(['va', 'mahasiswa'])->paginate(5);

    //     // Periksa apakah no_va kosong, jika iya set status_transaksi menjadi null
    //     foreach ($tagihan as $item) {
    //         if (is_null($item->no_va)) {
    //             $item->status_transaksi = null; // Kosongkan status_transaksi
    //         }
    //     }

    //     // Periksa apakah data ditemukan
    //     if ($tagihan->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'data' => 'Data Tidak Ditemukan'
    //         ], 200)->header('Access-Control-Allow-Origin', 'http://127.0.0.1:8000'); // Mengizinkan CORS
    //     } else {
    //         return response()->json([
    //             'success' => true,
    //             'data' => $tagihan
    //         ], 200)->header('Access-Control-Allow-Origin', 'http://127.0.0.1:8000'); // Mengizinkan CORS
    //     }
    // }

    /**
     * Menampilkan semua data VA.
     */
    public function listVa()
    {
        // Ambil semua data VA beserta relasi tagihan dan mahasiswa
        $vaData = Va::with(['tagihan', 'mahasiswa'])->paginate(10);

        // Jika tidak ada data
        if ($vaData->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Virtual Account tidak ditemukan.',
            ], 404);
        }

        // Return data VA
        return response()->json([
            'success' => true,
            'data' => $vaData,
        ], 200);
    }

    /**
     * Menampilkan detail VA berdasarkan nomor VA.
     */
    public function detailVa($no_va)
    {
        // Cari data VA berdasarkan nomor VA
        $va = Va::with(['tagihan', 'mahasiswa'])->where('no_va', $no_va)->first();

        // Jika data tidak ditemukan
        if (!$va) {
            return response()->json([
                'success' => false,
                'message' => 'Data Virtual Account tidak ditemukan.',
            ], 404);
        }

        // Return data detail VA
        return response()->json([
            'success' => true,
            'data' => $va,
        ], 200);
    }

    // GET: Menampilkan data tagihan
    public function getTagihan(Request $request)
    {
        $query = Tagihan::query();

        // Filter berdasarkan ID mahasiswa jika ada
        if ($request->filled('id_mahasiswa')) {
            $query->where('id_mahasiswa', 'like', '%' . $request->id_mahasiswa . '%');
        }

        // Pagination, 10 data per halaman
        $tagihan = $query->paginate(10);

        if ($tagihan->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => 'Data Tidak Ditemukan'
            ], 200)->header('Access-Control-Allow-Origin', '*');
        } else {
            return response()->json([
                'success' => true,
                'data' => $tagihan
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
    }

    // POST: Menambahkan data tagihan
    public function createTagihan(Request $request)
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
            'deskripsi' => 'nullable|string',
        ]);

        // Ambil data detail_tagihan
        $detailTagihan = DetailTagihan::where('id_dtl_tagihan', $request->id_dtl_tagihan)->first();

        if (!$detailTagihan) {
            return response()->json([
                'success' => false,
                'message' => 'Detail tagihan tidak ditemukan.'
            ], 404);
        }

        // Perhitungan jumlah tagihan
        $biayaSks = $detailTagihan->biaya_sks * $request->sks;
        $biayaIce = $request->ice === 'Mengambil' ? $detailTagihan->biaya_ICE : 0;
        $totalPotongan = $request->potongan_prestasi === 'Iya' ? $detailTagihan->potongan_prestasi : 0;
        $totalDenda = $request->denda === 'Iya' ? $detailTagihan->hrg_denda : 0;

        $jumlahTagihan = $biayaSks + $biayaIce + $detailTagihan->biaya_kesehatan + $detailTagihan->biaya_gedung - $totalPotongan + $totalDenda;

        // Simpan data tagihan ke database
        $tagihan = Tagihan::create([
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
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'data' => $tagihan
        ], 201);
    }

    // PUT: Mengupdate data tagihan
    public function updateTagihan(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $request->validate([
            'sks' => 'required|integer',
            'ice' => 'required|string',
            'potongan_prestasi' => 'required|string',
            'denda' => 'required|string',
            'periode' => 'required|string',
        ]);

        // Ambil data detail_tagihan untuk perhitungan baru
        $detailTagihan = DetailTagihan::where('id_dtl_tagihan', $tagihan->id_dtl_tagihan)->first();

        if (!$detailTagihan) {
            return response()->json([
                'success' => false,
                'message' => 'Detail tagihan tidak ditemukan.'
            ], 404);
        }

        // Lakukan perhitungan ulang jumlah tagihan
        $biayaSks = $detailTagihan->biaya_sks * $request->sks;
        $biayaIce = $request->ice === 'Mengambil' ? $detailTagihan->biaya_ICE : 0;
        $totalPotongan = $request->potongan_prestasi === 'Iya' ? $detailTagihan->potongan_prestasi : 0;
        $totalDenda = $request->denda === 'Iya' ? $detailTagihan->hrg_denda : 0;

        $jumlahTagihan = $biayaSks + $biayaIce + $detailTagihan->biaya_kesehatan + $detailTagihan->biaya_gedung - $totalPotongan + $totalDenda;

        // Update tagihan dengan data baru
        $tagihan->update([
            'sks' => $request->sks,
            'ice' => $request->ice,
            'potongan_prestasi' => $request->potongan_prestasi,
            'denda' => $request->denda,
            'periode' => $request->periode,
            'jmlh_tgh' => $jumlahTagihan,
        ]);

        return response()->json([
            'success' => true,
            'data' => $tagihan
        ], 200);
    }
}
