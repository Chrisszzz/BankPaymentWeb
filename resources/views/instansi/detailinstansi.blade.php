@extends('layouts.main')
@section('title', 'Detail Data Instansi')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Detail Data Instansi</strong></h2>
    <h4 class="text-center text-primary">Universitas Kristen Duta Wacana</h4>

    <table class="table table-bordered table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Status Transaksi</th>
                <th>Verifikasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->mahasiswa->id_mahasiswa }}</td>
                    <td>{{ $data->mahasiswa->nm_mhs }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>Rp. {{ number_format($data->jmlh, 2, ',', '.') }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        @if ($data->is_verified)
                            <span class="badge badge-success">Terverifikasi</span>
                        @else
                            <span class="badge badge-warning">Belum Terverifikasi</span>
                        @endif
                    </td>
                    <td>
                        @if (!$data->is_verified)
                            <form action="{{ route('transaksi.verifikasi', $data->id_transaksi) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Verifikasi</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Sudah Diverifikasi</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <nav aria-label="Pagination" class="mx-auto">
            {{ $transaksi->links() }}
        </nav>
    </div>
</div>
@endsection
