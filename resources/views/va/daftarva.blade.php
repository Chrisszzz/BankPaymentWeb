@extends('layouts.main')
@section('title', 'Daftar Request Data VA')
<style>
    form label {
    font-weight: bold;
    color: #3F51B5;
}

form input {
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    background-color: #3F51B5;
    border: none;
    color: white;
}
</style>

@section('title', 'Daftar Request Data VA')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Daftar Request Data VA</strong></h2>

    <!-- Form Filter -->
    <form action="{{ url('/va') }}" method="GET" class="mb-4 d-flex align-items-center">
        <input type="text" name="nama_instansi" class="form-control me-2" placeholder="Cari Nama Instansi" value="{{ request('nama_instansi') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url('/va') }}" class="btn btn-secondary ms-2">Reset</a>
    </form>

    <!-- Table Data -->
    <table class="table table-striped table-bordered">
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
                <td>{{ $item->total_mahasiswa }} Orang</td>
                <td>
                    <a href="/instansi/edit/{{ $item->id }}" class="btn btn-info btn-sm">Lihat Detail</a>
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
