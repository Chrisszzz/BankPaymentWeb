@extends('layouts.main2')

@section('title', 'Manajemen Pembayaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Manajemen Pembayaran</strong></h2>

    <!-- Table for Komponen Pembayaran -->
    <div class="table-responsive">
        <br>
        <h4>Table Komponen Pembayaran</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kategori Pembayaran</th>
                    <th>Deskripsi</th>
                    <th>Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SKS</td>
                    <td>Pembayaran per 1 SKS mahasiswa</td>
                    <td>Rp. {{ number_format($detailTagihan->biaya_sks, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>ICE</td>
                    <td>Pembayaran ICE</td>
                    <td>Rp. {{ number_format($detailTagihan->biaya_ICE, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Uang Kesehatan</td>
                    <td>Pembayaran Kesehatan</td>
                    <td>Rp. {{ number_format($detailTagihan->biaya_kesehatan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Uang Gedung</td>
                    <td>Pembayaran Gedung</td>
                    <td>Rp. {{ number_format($detailTagihan->biaya_gedung, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Denda telat/hari</td>
                    <td>Pembayaran denda keterlambatan</td>
                    <td>Rp. {{ number_format($detailTagihan->hrg_denda, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table for Potongan_Prestasi -->
    <div class="table-responsive mt-4">
        <h4>Table Atur Potongan Prestasi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kategori Potongan Prestasi</th>
                    <th>Kriteria</th>
                    <th>Potongan Prestasi (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Akademik/Non Akademik</td>
                    <td>Prestasi Akademik/Non Akademik</td>
                    <td>Rp. {{ number_format($detailTagihan->potongan_prestasi, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
