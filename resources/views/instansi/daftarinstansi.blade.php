@extends('layouts.main')
@section('title', 'Data Instansi')

@section('content')
<div class="container mt-5">
    <h3>Daftar Instansi</h3>
    <a href="/instansi/create" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-2">  </i>Tambah Instansi
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
            @foreach ($instansi as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->kode_instansi }}</td>
                    <td>{{ $data->nm_instansi }}</td>
                    <td>{{ $data->total_mahasiswa }}</td>
                    <td>{{ $data->tgl_mulai_kerjasama }}</td>
                    <td>{{ $data->tgl_akhir_kerjasama }}</td>
                    <td>
                        <!-- Tombol Edit dan Hapus dalam satu baris -->
                        <div class="d-flex gap-2">
                            <a href="/instansi/edit/{{ $data->id }}"  class ="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
                            <form action="/instansi/delete/{{ $data->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
