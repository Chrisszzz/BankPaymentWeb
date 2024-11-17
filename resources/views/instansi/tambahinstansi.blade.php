@extends('layouts.main')
@section('title', 'Tambah Data Instansi')

@section('content')
<div class="container mt-5">
    <h3 class="text-center">Form Tambah Data Instansi</h3>
    <form action="/instansi/store" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode Universitas</label>
            <input type="text" name="kode_instansi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Universitas</label>
            <input type="text" name="nm_instansi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Total Mahasiswa</label>
            <input type="text" name="total_mahasiswa" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai Kerjasama</label>
            <input type="date" name="tgl_mulai_kerjasama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Berakhir Kerjasama</label>
            <input type="date" name="tgl_akhir_kerjasama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>
@endsection
