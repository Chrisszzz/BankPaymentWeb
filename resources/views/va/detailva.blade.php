@extends('layouts.main')
@section('title', 'Data VA')

<style>
    table {
        font-size: 14px;
    }

    /* Menjadikan header tabel berwarna putih biasa */
    table th {
        background-color: white;
        color: black;
    }

    table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #3F51B5;
        border: none;
    }

    .card-body {
        padding: 15px;
    }

    /* Styling untuk card */
    .card-header {
        color: white;
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Daftar Request VA</strong></h2>
        <p class="text-center"><strong>Universitas Kristen Duta Wacana</strong></p>
        <br>

        <!-- Card untuk tabel -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Data VA</h5>
            </div>
            <div class="card-body">
                <!-- Tabel Data -->
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Instansi</th>
                            <th>NIM Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nominal Tagihan</th>
                            <th>Tanggal Request</th>
                            <th>Jenis Layanan</th>
                            <th>Nomor VA</th>
                            <th>Status Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut dimulai dari 1 -->
                                <td>{{ $item->id_instansi }}</td>
                                <td>{{ $item->id_mahasiswa }}</td>
                                <td>{{ $item->mahasiswa->nm_mhs ?? 'Nama tidak ditemukan' }}</td>
                                <td>Rp {{ number_format($item->jmlh_tgh, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->no_va }}</td>
                                <td>
                                    @if (is_null($item->status_transaksi))
                                        <span class="text-secondary"></span>
                                    @elseif($item->status_transaksi == 'Menunggu Pembayaran')
                                        <span class="text-info">Menunggu Pembayaran</span>
                                    @elseif($item->status_transaksi == 'Sudah Bayar')
                                        <span class="text-success">Sudah Bayar</span>
                                    @else
                                        <span class="text-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($item->no_va))
                                        <!-- Jika no_va kosong, tampilkan tombol generate -->
                                        <form action="{{ route('va.generate', $item->id_tagihan) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Proses</button>
                                        </form>
                                    @else
                                        <span class="text-success">Berhasil Digenerate</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $tagihan->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
