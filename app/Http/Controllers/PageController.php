<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\Tagihan;
use App\Va;
use App\Mahasiswa;
use App\DetailTagihan;
use App\KomponenPembayaran;
use App\Transaksi;
use Illuminate\Support\Facades\Log;
use Exception;

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

        // Ambil total tagihan
        $totalTagihan = Tagihan::sum('jmlh_tgh');

        // Ambil total instansi
        $totalInstansi = Instansi::count();

        // Ambil jumlah tagihan yang "Menunggu Pembayaran"
        $menungguPembayaranCount = Tagihan::where('status_transaksi', 'Menunggu Pembayaran')->count();

        return view('home', compact('totalTagihan', 'totalInstansi', 'menungguPembayaranCount'));
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
        $periode = $request ->input('periode');
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
            'periode' => $periode,
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

    public function tambahmahasiswa()
    {
        return view('mahasiswa.tambah_mahasiswa');
    }

    public function formtambahmahasiswa()
    {
        return view('mahasiswa.form_tambah_mahasiswa');
    }

    public function detailva()
    {
        // Ambil data tagihan beserta relasi VA dan Mahasiswa
        $tagihan = Tagihan::with(['va', 'mahasiswa'])->paginate(5);
        // Periksa apakah no_va kosong, jika iya set status_transaksi menjadi null
        foreach ($tagihan as $item) {
            if (is_null($item->no_va)) {
                $item->status_transaksi = null; // Kosongkan status_transaksi
            }
        }

        return view('va.detailva', compact('tagihan'));
    }

    // public function generateVa($id)
    // {
    // // Cari data tagihan berdasarkan ID
    // $tagihan = Tagihan::findOrFail($id);

    // // Cek jika status_transaksi sudah "Sudah Bayar"
    // if ($tagihan->status_transaksi == 'Sudah Bayar') {
    //     return redirect()->back()->with('error', 'Tagihan sudah dibayar, tidak dapat di-generate ulang.');
    // }

    // // Generate nomor VA baru
    // $generatedVa = $tagihan->id_instansi . $tagihan->id_mahasiswa;

    // // Update no_va dan status_transaksi pada tagihan
    // $tagihan->update([
    //     'no_va' => $generatedVa,
    //     'status_transaksi' => 'Menunggu Pembayaran', // Tetap menunggu pembayaran
    // ]);

    // return redirect()->back()->with('success', 'Nomor VA berhasil digenerate.');
    // }

    public function generateVa($id)
    {
    // Cari data tagihan berdasarkan ID
        $tagihan = Tagihan::findOrFail($id);

    // Cek jika status_transaksi sudah "Sudah Bayar"
        if ($tagihan->status_transaksi == 'Sudah Bayar') {
            return redirect()->back()->with('error', 'Tagihan sudah dibayar, tidak dapat di-generate ulang.');
        }

    // Ambil data instansi dan mahasiswa
        $instansiId = $tagihan->id_instansi;
        $mahasiswaId = $tagihan->id_mahasiswa;

    // Format VA: ID_INSTANSI-ID_MAHASISWA
        $noVa = $instansiId . $mahasiswaId;

    // Buat data VA baru
        Va::create([
            'no_va' => $noVa,
            'id_mahasiswa' => $mahasiswaId,
            'id_tagihan' => $tagihan->id_tagihan,
        'status_va' => 'Aktif', // Set status VA menjadi Aktif
    ]);

    // Update no_va dan status_transaksi pada tagihan
        $tagihan->update([
            'no_va' => $noVa,
        'status_transaksi' => 'Menunggu Pembayaran', // Tetap menunggu pembayaran
    ]);

        return redirect()->back()->with('success', 'Nomor VA berhasil digenerate.');
    }

    public function daftarTransaksi()
    {
    // Ambil data transaksi beserta tagihan dan mahasiswa, kecuali yang statusnya 'Gagal'
        $transaksi = Transaksi::with(['tagihan.mahasiswa'])
        ->where('status', '!=', 'Gagal')  // Exclude transactions with status 'Gagal'
        ->get();

    // Perbarui status berdasarkan kondisi
        foreach ($transaksi as $data) {
            if ($data->jmlh_bayar == $data->tagihan->jmlh_tgh) {
                $data->update(['status' => 'Sudah Bayar']);
                $data->tagihan->update(['status_transaksi' => 'Sudah Bayar']);
            } elseif ($data->jmlh_bayar != $data->tagihan->jmlh_tgh) {
                $data->update(['status' => 'Gagal']);
                $data->tagihan->update(['status_transaksi' => 'Gagal']);
            }
        }

        return view('transaksi.transaksi', ['transaksi' => $transaksi]);
    }


    public function verifikasiTransaksi(Request $request, $id)
    {
    // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

    // Perbarui status verifikasi menjadi 'Sudah Terverifikasi'
        $transaksi->update([
            'status_verifikasi' => 'Sudah Terverifikasi'
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diverifikasi.');
    }

    public function logtransaksi(Request $request)
    {
    // Query dasar dengan relasi
        $query = Transaksi::with(['tagihan.mahasiswa', 'tagihan.instansi']);

        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('created_at', [
                $request->tanggal_dari . ' 00:00:00',
                $request->tanggal_sampai . ' 23:59:59',
            ]);
        }


    // Filter berdasarkan keyword di instansi atau mahasiswa
        if ($request->filled('filter_keyword')) {
            $keyword = $request->filter_keyword;
            $query->whereHas('tagihan.instansi', function ($q) use ($keyword) {
                $q->where('nm_instansi', 'like', '%' . $keyword . '%');
            })->orWhereHas('tagihan.mahasiswa', function ($q) use ($keyword) {
                $q->where('nm_mhs', 'like', '%' . $keyword . '%')
                ->orWhere('id_mahasiswa', 'like', '%' . $keyword . '%');
            });
        }

    // Ambil data dan transformasi
        $transaksi = $query->get()->map(function ($item) {
            return [
                'no_va' => $item->tagihan->no_va,
                'nama_mahasiswa' => $item->tagihan->mahasiswa->nm_mhs ?? '-',
                'nama_instansi' => $item->tagihan->instansi->nm_instansi ?? '-',
                'jenis_tagihan' => $item->tagihan->deskripsi ?? '-',
                'tanggal_transaksi' => $item->created_at->format('d - m - Y'),
                'total_bayar' => 'Rp. ' . number_format($item->jmlh_bayar, 0, ',', '.'),
                'status_transaksi' => $item->status,
            ];
        });

    // Kirim ke view
        return view('transaksi.logtransaksi', compact('transaksi'));
    }

    public function komponen_pembayaran(Request $request)
    {
        $data = KomponenPembayaran::getKomponenPembayaran($request);
        return view('komponen_pembayaran.index',compact('data'));
    }
    public function save_komponen_pembayaran(Request $request)
    {
        $jumlah_komponen = preg_replace("/[^aZ0-9]/", "", $request->jumlah_komponen);
        $data = New KomponenPembayaran();
        $data -> kategori_komponen = $request->kategori_komponen;
        $data -> deskripsi_komponen = $request->deskripsi_komponen;
        $data -> jumlah_komponen = $jumlah_komponen;
        $data -> save();
        return response()->json(['status'=>'true', 'message'=>'Data Manajemen Pembayaran berhasil ditambahkan !!']);
    }
    public function get_edit_komponen_pembayaran($id_komponen_pembayaran)
    {
        $data = KomponenPembayaran::getEditKomponenPembayaran($id_komponen_pembayaran);
        return response()->json($data);
    }
    public function update_komponen_pembayaran(Request $request)
    {
        $jumlah_komponen = preg_replace("/[^aZ0-9]/", "", $request->jumlah_komponen);
        $data = KomponenPembayaran::where('id_komponen_pembayaran',$request->id_komponen_pembayaran)->first();
        $data -> kategori_komponen = $request->kategori_komponen;
        $data -> deskripsi_komponen = $request->deskripsi_komponen;
        $data -> jumlah_komponen = $jumlah_komponen;
        $data -> save();
        return response()->json(['status'=>'true', 'message'=>'Data Manajemen Pembayaran berhasil diubah !!']);
    }
    public function hapus_komponen_pembayaran($id_komponen_pembayaran)
    {
        $data = KomponenPembayaran::where('id_komponen_pembayaran',$id_komponen_pembayaran)->first();
        $data -> delete();
        return response()->json(['status'=>'true', 'message'=>'Data Manajemen Pembayaran berhasil dihapus !!']);
    }


}




