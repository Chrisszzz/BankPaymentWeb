<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tagihan;
use App\DetailTagihan;
use App\Va;
use App\KomponenPembayaran;
use App\Mahasiswa;


class APIController extends Controller
{
    public function listVa(Request $request)
    {
        $query = Va::with(['tagihan', 'mahasiswa']);

        // Filter berdasarkan ID mahasiswa jika diberikan
        if ($request->filled('id_mahasiswa')) {
            $query->where('id_mahasiswa', $request->id_mahasiswa);
        }

        $vaData = $query->paginate(10);

        if ($vaData->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Virtual Account tidak ditemukan.',
            ], 404);
        }

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

    public function detailVaMahasiswa($id_mahasiswa)
    {
        // Mengambil data VA berdasarkan id_mahasiswa
        $va = Va::with(['tagihan', 'mahasiswa'])
            ->where('id_mahasiswa', $id_mahasiswa) // Filter berdasarkan ID mahasiswa
            ->first(); // Hanya ambil data pertama

        // Jika data VA tidak ditemukan
        if (!$va) {
            return response()->json([
                'success' => false,
                'message' => 'Data VA tidak ditemukan untuk ID mahasiswa ini.',
            ], 404);
        }

        // Mengembalikan data VA dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Data VA berhasil diambil.',
            'data' => $va,
        ], 200);
    }

    // GET: Menampilkan data tagihan
    public function getTagihan(Request $request)
    {
        $query = Tagihan::with('detailTagihan');

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

    // GET: Menampilkan detail data tagihan berdasarkan ID
    public function getDetailTagihan($id)
    {
        // Mencari tagihan berdasarkan ID
        $tagihan = Tagihan::with('detailTagihan')->find($id);

        if (!$tagihan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ], 404)->header('Access-Control-Allow-Origin', '*');
        }

        return response()->json([
            'success' => true,
            'data' => $tagihan
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }

    public function getDetailTagihanMhs($id_mahasiswa)
    {
        try {
            // Validasi apakah mahasiswa dengan id_mahasiswa ada
            $mahasiswa = Mahasiswa::find($id_mahasiswa);
            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa tidak ditemukan.'
                ], 404);
            }

            // Ambil data tagihan berdasarkan id_mahasiswa
            $tagihan = Tagihan::where('id_mahasiswa', $id_mahasiswa)->with(['detailTagihan', 'va'])->get();

            if ($tagihan->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada tagihan untuk mahasiswa ini.'
                ], 404);
            }

            // Mengembalikan response dalam bentuk JSON
            return response()->json([
                'success' => true,
                'message' => 'Data tagihan berhasil diambil.',
                'data' => $tagihan
            ], 200);

        } catch (\Exception $e) {
            // Tangani jika ada error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data tagihan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // POST: Menambahkan data tagihan
    public function createTagihan(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|integer',
            'periode' => 'required|string',
            'sks' => 'required|integer',
            'ice' => 'required|string',
            'potongan_prestasi' => 'required|string',
            'denda' => 'required|string',
            'tgl_jth_tempo' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        // Default nilai
        $idInstansi = 12345;
        $idDtlTagihan = 1;

        // Ambil data detail_tagihan
        $detailTagihan = DetailTagihan::find($idDtlTagihan);

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
            'id_instansi' => $idInstansi,
            'id_dtl_tagihan' => $idDtlTagihan,
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
            'tgl_jth_tempo' => 'required|date',
            'deskripsi' => 'nullable|string'
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
            'tgl_jth_tempo' => $request->tgl_jth_tempo,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'data' => $tagihan
        ], 200);
    }

    // DELETE data tagihan
    public function deleteTagihan($id_tagihan)
    {
        // Cari tagihan berdasarkan id_tagihan
        $tagihan = Tagihan::find($id_tagihan);

        if (!$tagihan) {
            // Jika tagihan tidak ditemukan, kirim respons 404
            return response()->json([
                'success' => false,
                'message' => 'Tagihan tidak ditemukan.'
            ], 404);
        }

        // Hapus tagihan
        $tagihan->delete();

        // Kirim respons sukses setelah penghapusan
        return response()->json([
            'success' => true,
            'message' => 'Tagihan berhasil dihapus.'
        ], 200);
    }

    // GET: Menampilkan data komponen pembayaran
    public function getManajemenPembayaran(Request $request)
    {
        // Query untuk mendapatkan data komponen pembayaran
        $query = KomponenPembayaran::query();

        // Filter berdasarkan nama atau atribut lain jika diperlukan
        if ($request->filled('filter')) {
            $query->where('nama_komponen', 'like', '%' . $request->filter . '%');
        }

        // Pagination, 10 data per halaman
        $komponenPembayaran = $query->paginate(10);

        if ($komponenPembayaran->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }

        return response()->json([
            'success' => true,
            'data' => $komponenPembayaran,
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }


}
