<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Tagihan;
use Mpdf\Mpdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function exportPdf(Request $request)
    {
        // Ambil data transaksi dengan filter
        $query = Transaksi::with(['tagihan.mahasiswa', 'tagihan.instansi']);

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $tanggalDari = Carbon::parse($request->tanggal_dari)->startOfDay(); // 00:00:00
            $tanggalSampai = Carbon::parse($request->tanggal_sampai)->endOfDay(); // 23:59:59
            $query->whereBetween('created_at', [$tanggalDari, $tanggalSampai]);
        }

        // Filter berdasarkan keyword
        if ($request->filled('filter_keyword')) {
            $query->whereHas('tagihan.instansi', function ($q) use ($request) {
                $q->where('nm_instansi', 'like', '%' . $request->filter_keyword . '%');
            })->orWhereHas('tagihan.mahasiswa', function ($q) use ($request) {
                $q->where('nm_mhs', 'like', '%' . $request->filter_keyword . '%');
            });
        }

        // Ambil data transaksi
        $transaksi = $query->get()->map(function ($item) {
            return [
                'no_va' => $item->tagihan->no_va,
                'nama_mahasiswa' => $item->tagihan->mahasiswa->nm_mhs ?? '-',
                'nama_instansi' => $item->tagihan->instansi->nm_instansi ?? '-',
                'jenis_tagihan' => $item->tagihan->deskripsi ?? '-',
                'tanggal_transaksi' => $item->created_at->format('d-m-Y'),
                'total_bayar' => 'Rp. ' . number_format($item->jmlh_bayar, 0, ',', '.'),
                'status_transaksi' => $item->status,
            ];
        });

        // Konversi data menjadi HTML
        $html = view('transaksi.pdf_template', compact('transaksi'))->render();

        // Generate PDF menggunakan mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Unduh PDF
        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S'); // 'S' untuk output sebagai string
        }, 'log_transaksi.pdf');
    }


}
