@extends('layouts.main2')
@section('title', 'Data Pembayaran')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><strong>Data Pembayaran</strong></h4>
        </div>
        <div class="card-body px-3 py-3">
            <!-- Baris untuk tombol tambah data dan search bar -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Tombol Tambah Data -->
                <a href="/pembayaran/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data
                </a>

                <!-- Form Filter -->
                <form action="{{ url('/pembayaran') }}" method="GET" class="d-flex align-items-center" style="max-width: 300px;">
                    <input type="text" name="id_mahasiswa" class="form-control me-2 w-auto" placeholder="Cari NIM Mahasiswa" value="{{ request('id_mahasiswa') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-striped text-center table-sm w-100">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Periode</th>
                            <th>SKS</th>
                            <th>ICE</th>
                            <th>Kesehatan</th>
                            <th>Gedung</th>
                            <th>Prestasi</th>
                            <th>Denda</th>
                            <th>No VA</th>
                            <th>Status Transaksi</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tagihan as $key => $data)
                            <tr>
                                <td>{{ $tagihan->firstItem() + $key }}</td>
                                <td>{{ $data->id_mahasiswa }}</td>
                                <td>{{ $data->periode }}</td>
                                <td>
                                    {{ $data->sks }} SKS
                                    ({{ $data->detailTagihan ? 'Rp. ' . number_format($data->detailTagihan->biaya_sks * $data->sks, 0, ',', '.') : '-' }})
                                </td>
                                <td>
                                    {{ $data->ice === 'Mengambil' && $data->detailTagihan ? 'Rp. ' . number_format($data->detailTagihan->biaya_ICE ?? 0, 0, ',', '.') : 'Rp. 0' }}
                                </td>
                                <td>{{ 'Rp. ' . number_format($data->detailTagihan->biaya_kesehatan ?? 0, 0, ',', '.') }}</td>
                                <td>{{ 'Rp. ' . number_format($data->detailTagihan->biaya_gedung ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $data->potongan_prestasi === 'Iya' ? 'Rp. ' . number_format($data->detailTagihan->potongan_prestasi ?? 0, 0, ',', '.') : 'Rp. 0' }}</td>
                                <td>{{ $data->denda === 'Iya' ? 'Rp. ' . number_format($data->detailTagihan->hrg_denda ?? 0, 0, ',', '.') : 'Rp. 0' }}</td>
                                <td>{{ $data->no_va }}</td>
                                <td>
                                    <span class="badge bg-{{ $data->status_transaksi === 'Lunas' ? 'success' : 'warning' }}">
                                        {{ $data->status_transaksi }}
                                    </span>
                                </td>
                                <td>{{ 'Rp. ' . number_format($data->jmlh_tgh, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/pembayaran/edit/{{ $data->id_tagihan }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="/pembayaran/delete/{{ $data->id_tagihan }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">Tidak ada data pembayaran ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

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
    </div>
</div>
@endsection
