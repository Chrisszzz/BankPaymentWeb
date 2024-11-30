@extends('layouts.main')
@section('title', 'Data VA')

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

    .btn-primary {
        background-color: #3F51B5;
        border: none;
    }

    .search-bar-container {
        display: flex;
        justify-content: flex-end; /* Menempatkan form di sebelah kanan */
        margin-bottom: 20px;
    }

    .form-control {
        max-width: 300px; /* Membatasi lebar search bar */
    }
</style>

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Data VA</strong></h2>

    <!-- Form Filter -->
    <div class="search-bar-container">
        <form action="{{ url('/va') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="nama_instansi" class="form-control me-2" placeholder="Cari Nama Instansi" value="{{ request('nama_instansi') }}">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ url('/va') }}" class="btn btn-secondary ms-2">Reset</a>
        </form>
    </div>

    <!-- Table Data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Universitas</th>
                <th>Nama Universitas</th>
                <th>Jenis Layanan</th>
                <th>Total Mahasiswa</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instansi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_instansi }}</td>
                <td>{{ $item->nm_instansi }}</td>
                <td>Pembayaran</td>
                <td>{{ $item->total_mahasiswa }}</td>
                <td>
                    <center><a href="va/detailva" class="btn btn-primary btn-sm">Lihat Detail</a></center>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <!-- Pagination Custom -->
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
