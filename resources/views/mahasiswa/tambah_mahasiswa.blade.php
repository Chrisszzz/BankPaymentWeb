@extends('layouts.main')
@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Tambah Data Mahasiswa/i</strong></h2>
        <a href="/formtambahmahasiswa" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-2">&nbsp;</i>Tambah Data
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Filter -->
        <form action="#" method="GET" class="mb-4 d-flex align-items-center">
            <input type="text" name="id_mahasiswa" class="form-control me-2" placeholder=""
                value="{{ request('id_mahasiswa') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- Tabel Data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>72220120</td>
                    <td>Alexius</td>
                    <td>2022</td>
                    <td>Sistem Informasi</td>
                    <td>Laki-laki</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/mahasiswa/edit/1" class="btn btn-success"><i class="bi bi-pencil-fill"></i> Edit</a>
                            <form action="/mahasiswa/delete/1" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>72220502</td>
                    <td>Joy</td>
                    <td>2022</td>
                    <td>Sistem Informasi</td>
                    <td>Perempuan</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/mahasiswa/edit/2" class="btn btn-success"><i class="bi bi-pencil-fill"></i> Edit</a>
                            <form action="/mahasiswa/delete/2" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="text-align: right;">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>





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
