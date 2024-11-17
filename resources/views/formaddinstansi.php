@extends('layouts/main')
@section('title','Form Data Intansi')
@section('artikel')
    <div class="card-header text-center">
        <h3>Form Data Intansi</h3>
    </div>
    <div class="card-body">
        <form action="/save" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Kode Universitas</label>
                <input type="text" name="kode_universitas" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nama Universitas</label>
                <input type="text" name="nama_universitas" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Total Mahasiswa</label>
                <input type="number" name="total_mahasiswa" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tanggal Mulai Kerjasama</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tanggal Berakhir Kerjasama</label>
                <input type="date" name="tanggal_berakhir" class="form-control" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
@endsection
