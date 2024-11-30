@extends('layouts.main')
@section('title', 'Data Transaksi')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Daftar Transaksi</strong></h2>
        <br>
        <div class="card">
            <div class="card-header" style="background-color: #3F51B5; color: white;">
                <h5>Daftar Transaksi</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->tagihan->instansi->nm_instansi ?? 'N/A' }}</td>
                                <td>{{ $data->tagihan->mahasiswa->nm_mhs ?? 'N/A' }}</td>
                                <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($data->jmlh_bayar, 0, ',', '.') }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    @if ($data->status_verifikasi == 'Belum Terverifikasi')
                                        <form action="{{ route('transaksi.verifikasi', $data->id_transaksi) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                                        </form>
                                    @else
                                        <span class="text-success">Sudah Terverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
