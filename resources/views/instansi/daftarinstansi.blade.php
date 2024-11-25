@extends('layouts.main')
@section('title', 'Data Instansi')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Data Instansi</strong></h2>
    <a href="/instansi/create" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-2">&nbsp;</i>Tambah Instansi
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Filter -->
    <form action="{{ url('/instansi') }}" method="GET" class="mb-4 d-flex align-items-center">
        <input type="text" name="nama_instansi" class="form-control me-2" placeholder="Cari Nama Instansi" value="{{ request('nama_instansi') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url('/instansi') }}" class="btn btn-secondary ms-2">Reset</a>
    </form>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Universitas</th>
                <th>Nama Universitas</th>
                <th>Total Mahasiswa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instansi as $key => $data)
                <tr>
                    <td>{{ $instansi->firstItem() + $key }}</td>
                    <td>{{ $data->kode_instansi }}</td>
                    <td>{{ $data->nm_instansi }}</td>
                    <td>{{ $data->total_mahasiswa }}</td>
                    <td>{{ $data->tgl_mulai_kerjasama }}</td>
                    <td>{{ $data->tgl_akhir_kerjasama }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/instansi/edit/{{ $data->id }}" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
                            <form action="/instansi/delete/{{ $data->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Custom Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <nav aria-label="Pagination" class="mx-auto">
            <ul class="pagination">
                <!-- Tombol Previous -->
                <li class="page-item {{ $instansi->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $instansi->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Tombol Halaman -->
                @foreach ($instansi->getUrlRange(
                    max(1, $instansi->currentPage() - 2),
                    min($instansi->lastPage(), $instansi->currentPage() + 2)
                ) as $page => $url)
                    <li class="page-item {{ $instansi->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Tombol Next -->
                <li class="page-item {{ !$instansi->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $instansi->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
