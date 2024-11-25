@extends('layouts.main')
@section('title', 'Report Tagihan')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Report Tagihan</strong></h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tanggal -->
        <div class="form-group mb-4 d-flex justify-content-end">
            <input type="date" name="tanggal" class="form-control" style="width: 18%;" required>
        </div>             

        <!-- Tabel Data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="8" class="text-center align-middle">Data</th>
                    <th rowspan="2" class="text-center align-middle">Action</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Tagihan</th>
                    <th>Potongan Harga</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


        {{-- <!-- Custom Pagination -->
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
                @foreach ($tagihan->getUrlRange(max(1, $tagihan->currentPage() - 2), min($tagihan->lastPage(), $tagihan->currentPage() + 2)) as $page => $url)
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
    </div> --}}
    </div>
@endsection
