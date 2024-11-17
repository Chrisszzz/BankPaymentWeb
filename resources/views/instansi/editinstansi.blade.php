@extends('layouts.main')
@section('title', 'Edit Data Instansi')

@section('content')
<div class="container mt-5">
    <h3 class="text-center">Form Edit Data Instansi</h3>
    <form action="/instansi/edit/{{ $instansi->id }}" method="POST">
        @csrf
        @method('PUT') <!-- Metode HTTP PUT -->

        <!-- Input hidden untuk ID instansi -->
        <input type="hidden" name="id" value="{{ $instansi->id }}">

        <div class="form-group">
            <label>Kode Universitas</label>
            <input type="text" name="kode_instansi" value="{{ $instansi->kode_instansi }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Universitas</label>
            <input type="text" name="nm_instansi" value="{{ $instansi->nm_instansi }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Total Mahasiswa</label>
            <input type="text" name="total_mahasiswa" value="{{ $instansi->total_mahasiswa }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai Kerjasama</label>
            <input type="date" name="tgl_mulai_kerjasama" value="{{ $instansi->tgl_mulai_kerjasama }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Berakhir Kerjasama</label>
            <input type="date" name="tgl_akhir_kerjasama" value="{{ $instansi->tgl_akhir_kerjasama }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="/instansi" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
