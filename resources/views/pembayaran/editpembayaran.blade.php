@extends('layouts.main2')
@section('title', 'Edit Data Pembayaran')
@section('content')
<div class="container mt-5">
    <h3 class="text-center"><strong>Edit Data Pembayaran</strong></h3>
    <form action="{{ url('/pembayaran/edit/' . $tagihan->id_tagihan) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ID Mahasiswa -->
        <div class="form-group">
            <label for="id_mahasiswa">NIM</label>
            <input type="text" name="id_mahasiswa" id="id_mahasiswa" class="form-control" value="{{ $tagihan->id_mahasiswa }}" readonly>
        </div>

        <!-- Periode -->
        <div class="form-group">
            <label for="periode">Periode</label>
            <input type="text" name="periode" id="periode" class="form-control" value="{{ $tagihan->periode }}" required>
        </div>

        <!-- ICE -->
        <div class="form-group">
            <label>ICE</label>
            <div class="d-flex">
                <div class="form-check me-4">
                    <input type="radio" name="ice" id="ice_mengambil" value="Mengambil" class="form-check-input" {{ $tagihan->ice == 'Mengambil' ? 'checked' : '' }}>
                    <label for="ice_mengambil" class="form-check-label">Mengambil</label>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-check">
                    <input type="radio" name="ice" id="ice_tidak_mengambil" value="Tidak Mengambil" class="form-check-input" {{ $tagihan->ice == 'Tidak Mengambil' ? 'checked' : '' }}>
                    <label for="ice_tidak_mengambil" class="form-check-label">Tidak Mengambil</label>
                </div>
            </div>
        </div>

        <!-- SKS -->
        <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" name="sks" id="sks" class="form-control" value="{{ $tagihan->sks }}" required>
        </div>

        <!-- Potongan Prestasi -->
        <div class="form-group">
            <label>Potongan Prestasi (Akademik/Non Akademik)</label>
            <div class="d-flex">
                <div class="form-check me-4">
                    <input type="radio" name="potongan_prestasi" id="potongan_ya" value="Iya" class="form-check-input" {{ $tagihan->potongan_prestasi == 'Iya' ? 'checked' : '' }}>
                    <label for="potongan_ya" class="form-check-label">Iya</label>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-check">
                    <input type="radio" name="potongan_prestasi" id="potongan_tidak" value="Tidak" class="form-check-input" {{ $tagihan->potongan_prestasi == 'Tidak' ? 'checked' : '' }}>
                    <label for="potongan_tidak" class="form-check-label">Tidak</label>
                </div>
            </div>
        </div>

        <!-- Denda -->
        <div class="form-group">
            <label>Denda</label>
            <div class="d-flex">
                <div class="form-check me-4">
                    <input type="radio" name="denda" id="denda_ya" value="Iya" class="form-check-input" {{ $tagihan->denda == 'Iya' ? 'checked' : '' }}>
                    <label for="denda_ya" class="form-check-label">Iya</label>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-check">
                    <input type="radio" name="denda" id="denda_tidak" value="Tidak" class="form-check-input" {{ $tagihan->denda == 'Tidak' ? 'checked' : '' }}>
                    <label for="denda_tidak" class="form-check-label">Tidak</label>
                </div>
            </div>
        </div>

        <!-- Tanggal Jatuh Tempo -->
        <div class="form-group">
            <label for="tgl_jth_tempo">Tanggal Jatuh Tempo</label>
            <input type="date" name="tgl_jth_tempo" id="tgl_jth_tempo" class="form-control" value="{{ $tagihan->tgl_jth_tempo }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ $tagihan->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-4">Simpan</button>
        <a href="/pembayaran" class="btn btn-secondary mt-4">Kembali</a>
    </form>
</div>
@endsection
