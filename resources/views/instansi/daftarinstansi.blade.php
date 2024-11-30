@extends('layouts.main')
@section('title', 'Data Instansi')

<style>
    table {
        font-size: 14px;
    }

    table th {
        background-color: #3F51B5;
        color: white;
    }

    table td {
        vertical-align: middle;
    }

    .btn-primary,
    .btn-secondary {
        background-color: #3F51B5;
        border: none;
    }

    .btn-primary:hover,
    .btn-secondary:hover {
        background-color: #303F9F;
    }

    .search-bar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        /* Untuk memastikan responsif */
    }

    .search-bar-container form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        max-width: 250px;
        /* Sesuaikan agar search bar tidak terlalu panjang */
    }

    .search-bar-container .btn {
        display: inline-flex;
        align-items: center;
    }

    .search-bar-container .btn i {
        margin-right: 5px;
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Data Instansi</strong></h2>

        <!-- Baris Search dan Tambah -->
        <div class="search-bar-container">
            <!-- Tombol Tambah Instansi -->
            <a href="/instansi/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>

            <!-- Form Filter -->
            <form action="{{ url('/instansi') }}" method="GET">
                <input type="text" name="nama_instansi" class="form-control" placeholder="Cari Nama Instansi"
                    value="{{ request('nama_instansi') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ url('/instansi') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data -->
        <table class="table table-striped">
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
                                <a href="/instansi/edit/{{ $data->id }}"
                                    class="btn btn-success d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="/instansi/delete/{{ $data->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
                    @foreach ($instansi->getUrlRange(max(1, $instansi->currentPage() - 2), min($instansi->lastPage(), $instansi->currentPage() + 2)) as $page => $url)
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
