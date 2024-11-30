@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="text-center mb-4"><strong>Log Transaksi</strong></h2>
    <br>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('logtransaksi') }}">
        <div class="row mb-3">
            <div class="col-md-2">
                <label for="tanggal_dari">Tanggal Awal</label>
                <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
            </div>
            <div class="col-md-2">
                <label for="tanggal_sampai">Tanggal Akhir</label>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
            </div>
            <div class="col-md-4">
                <label for="filter_keyword">Search</label>
                <input type="text" name="filter_keyword" id="filter_keyword" class="form-control" placeholder="Cari instansi atau mahasiswa" value="{{ request('filter_keyword') }}">
            </div>
            <div class="ms-2 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('logtransaksi') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-header" style="background-color: #3F51B5; color: white;">
            <h5>Log Transaksi</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>No. VA</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Instansi</th>
                        <th>Jenis Tagihan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Bayar</th>
                        <th>Status Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $data)
                        <tr>
                            <td>{{ $data['no_va'] }}</td>
                            <td>{{ $data['nama_mahasiswa'] }}</td>
                            <td>{{ $data['nama_instansi'] }}</td>
                            <td>{{ $data['jenis_tagihan'] }}</td>
                            <td>{{ $data['tanggal_transaksi'] }}</td>
                            <td>{{ $data['total_bayar'] }}</td>
                            <td>{{ $data['status_transaksi'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('logtransaksi.exportpdf', request()->all()) }}" class="btn btn-primary">Export PDF</a>
        </div>
    </div>
</div>
@endsection
