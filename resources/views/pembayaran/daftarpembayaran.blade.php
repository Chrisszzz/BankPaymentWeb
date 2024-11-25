@extends('layouts.main2')
@section('title', 'Data Pembayaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Data Pembayaran</strong></h2>
    <a href="/pembayaran/create" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-2">&nbsp;</i>Tambah Data
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Filter -->
    <form action="{{ url('/pembayaran') }}" method="GET" class="mb-4 d-flex align-items-center">
        <input type="text" name="id_mahasiswa" class="form-control me-2" placeholder="Cari NIM Mahasiswa" value="{{ request('id_mahasiswa') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url('/pembayaran') }}" class="btn btn-secondary ms-2">Reset</a>
    </form>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Periode</th>
                <th>SKS</th>
                <th>ICE</th>
                <th>Uang Kesehatan</th>
                <th>Uang Gedung</th>
                <th>Prestasi Akademik/Non Akademik</th>
                <th>Denda</th> <!-- Tambahkan kolom Denda -->
                <th>Jumlah Tagihan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tagihan as $key => $data)
                <tr>
                    <td>{{ $tagihan->firstItem() + $key }}</td>
                    <td>{{ $data->id_mahasiswa }}</td>
                    <td>{{ $data->periode }}</td>
                    <td>{{ $data->sks }}</td>
                    <td>{{ $data->ice }}</td>
                    <td>{{ $data->detailTagihan ? 'Rp. ' . number_format($data->detailTagihan->biaya_kesehatan, 0, ',', '.') : '-' }}</td>
                    <td>{{ $data->detailTagihan ? 'Rp. ' . number_format($data->detailTagihan->biaya_gedung, 0, ',', '.') : '-' }}</td>
                    <td>{{ $data->potongan_prestasi }}</td> <!-- Ya/Tidak -->
                    <td>{{ $data->denda }}</td> <!-- Ya/Tidak -->
                    <td>{{ 'Rp. ' . number_format($data->jmlh_tgh, 0, ',', '.') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/pembayaran/edit/{{ $data->id_tagihan }}" class="btn btn-success"><i class="bi bi-pencil-fill"></i>Edit</a>
                            <form action="/pembayaran/delete/{{ $data->id_tagihan }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data pembayaran ditemukan.</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    <!-- Custom Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <nav aria-label="Pagination" class="mx-auto">
            <ul class="pagination">
                <!-- Tombol Previous -->
                <li class="page-item {{ $tagihan->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tagihan->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Tombol Halaman -->
                @foreach ($tagihan->getUrlRange(
                    max(1, $tagihan->currentPage() - 2),
                    min($tagihan->lastPage(), $tagihan->currentPage() + 2)
                ) as $page => $url)
                    <li class="page-item {{ $tagihan->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Tombol Next -->
                <li class="page-item {{ !$tagihan->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tagihan->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
